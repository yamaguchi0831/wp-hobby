(function (blocks, blockEditor, components, element, i18n, apiFetch, serverSideRender) {
  const { registerBlockType } = blocks;
  const { InspectorControls, useBlockProps } = blockEditor;
  const { Button, ComboboxControl, Notice, PanelBody, Spinner } = components;
  const { createElement: el, useEffect, useState } = element;
  const { __, sprintf } = i18n;
  const ServerSideRender = serverSideRender.default || serverSideRender;

  registerBlockType("buybuycoms-hobby/column-purchase-records", {
    apiVersion: 2,
    title: __("買取実績（コラム用）", "buybuycoms-hobby"),
    description: __(
      "コラムのジャンルに紐づく買取実績を最大6件表示します。個別の実績も指定できます。",
      "buybuycoms-hobby",
    ),
    icon: "portfolio",
    category: "widgets",
    attributes: {
      selectedIds: {
        type: "array",
        items: { type: "number" },
        default: [],
      },
    },
    supports: { html: false },
    edit: function ({ attributes, setAttributes }) {
      const blockProps = useBlockProps();
      const selectedIds = Array.isArray(attributes.selectedIds)
        ? attributes.selectedIds.map(Number).filter(Boolean).slice(0, 6)
        : [];
      const [search, setSearch] = useState("");
      const [options, setOptions] = useState([]);
      const [selectedOptions, setSelectedOptions] = useState([]);
      const [isLoading, setIsLoading] = useState(false);
      const [hasError, setHasError] = useState(false);

      useEffect(
        function () {
          let isMounted = true;
          const timer = window.setTimeout(function () {
            setIsLoading(true);
            setHasError(false);
            apiFetch({
              path:
                "/buybuycoms-hobby/v1/purchase-record-options?search=" +
                encodeURIComponent(search),
            })
              .then(function (items) {
                if (isMounted) {
                  setOptions(
                    items.filter(function (item) {
                      return !selectedIds.includes(Number(item.value));
                    }),
                  );
                }
              })
              .catch(function () {
                if (isMounted) {
                  setOptions([]);
                  setHasError(true);
                }
              })
              .finally(function () {
                if (isMounted) {
                  setIsLoading(false);
                }
              });
          }, 250);

          return function () {
            isMounted = false;
            window.clearTimeout(timer);
          };
        },
        [search, selectedIds.join(",")],
      );

      useEffect(
        function () {
          let isMounted = true;

          if (!selectedIds.length) {
            setSelectedOptions([]);
            return function () {
              isMounted = false;
            };
          }

          apiFetch({
            path:
              "/buybuycoms-hobby/v1/purchase-record-options?include=" +
              selectedIds.join(","),
          })
            .then(function (items) {
              if (isMounted) {
                setSelectedOptions(items);
              }
            })
            .catch(function () {
              if (isMounted) {
                setSelectedOptions([]);
              }
            });

          return function () {
            isMounted = false;
          };
        },
        [selectedIds.join(",")],
      );

      function addRecord(value) {
        const recordId = Number(value);

        if (!recordId || selectedIds.includes(recordId) || selectedIds.length >= 6) {
          return;
        }

        setAttributes({ selectedIds: selectedIds.concat(recordId) });
        setSearch("");
      }

      function removeRecord(recordId) {
        setAttributes({
          selectedIds: selectedIds.filter(function (selectedId) {
            return selectedId !== recordId;
          }),
        });
      }

      function getSelectedLabel(recordId) {
        const selectedOption = selectedOptions.find(function (option) {
          return Number(option.value) === recordId;
        });

        return selectedOption
          ? selectedOption.label
          : sprintf(__("買取実績 ID: %d", "buybuycoms-hobby"), recordId);
      }

      return el(
        "div",
        blockProps,
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: __("買取実績設定", "buybuycoms-hobby"), initialOpen: true },
            el(
              "p",
              null,
              __(
                "個別指定を先に表示し、6件に満たない枠はコラムのジャンルに紐づく新着実績で補完します。",
                "buybuycoms-hobby",
              ),
            ),
            selectedIds.length >= 6
              ? el(
                  Notice,
                  { status: "info", isDismissible: false },
                  __("指定できる買取実績は最大6件です。", "buybuycoms-hobby"),
                )
              : el(ComboboxControl, {
                  label: __("買取実績を検索して追加", "buybuycoms-hobby"),
                  value: "",
                  options: options,
                  onFilterValueChange: setSearch,
                  onChange: addRecord,
                  help: __(
                    "タイトルで検索できます。候補には買取価格も表示されます。",
                    "buybuycoms-hobby",
                  ),
                }),
            isLoading ? el(Spinner) : null,
            hasError
              ? el(
                  Notice,
                  { status: "error", isDismissible: false },
                  __("買取実績を取得できませんでした。", "buybuycoms-hobby"),
                )
              : null,
            selectedIds.length
              ? el(
                  "ol",
                  null,
                  selectedIds.map(function (recordId) {
                    return el(
                      "li",
                      { key: recordId },
                      el("span", null, getSelectedLabel(recordId)),
                      el(
                        Button,
                        {
                          variant: "tertiary",
                          isDestructive: true,
                          onClick: function () {
                            removeRecord(recordId);
                          },
                        },
                        __("削除", "buybuycoms-hobby"),
                      ),
                    );
                  }),
                )
              : el(
                  "p",
                  null,
                  __("個別指定はありません。", "buybuycoms-hobby"),
                ),
          ),
        ),
        el(ServerSideRender, {
          block: "buybuycoms-hobby/column-purchase-records",
          attributes: { selectedIds: selectedIds },
        }),
      );
    },
    save: function () {
      return null;
    },
  });
})(
  window.wp.blocks,
  window.wp.blockEditor,
  window.wp.components,
  window.wp.element,
  window.wp.i18n,
  window.wp.apiFetch,
  window.wp.serverSideRender,
);
