(function (blocks, blockEditor, components, element, i18n, apiFetch, serverSideRender) {
  const { registerBlockType } = blocks;
  const { InspectorControls, useBlockProps } = blockEditor;
  const { ComboboxControl, PanelBody, SelectControl, Spinner } = components;
  const { createElement: el, useEffect, useState } = element;
  const { __ } = i18n;
  const ServerSideRender = serverSideRender.default || serverSideRender;

  registerBlockType("buybuycoms-hobby/internal-link-card", {
    apiVersion: 2,
    title: __("ページ内リンクカード", "buybuycoms-hobby"),
    description: __(
      "取り扱いジャンルまたはコラムへのリンクカードを挿入します。",
      "buybuycoms-hobby",
    ),
    icon: "admin-links",
    category: "widgets",
    attributes: {
      contentType: { type: "string", default: "genre" },
      contentId: { type: "number", default: 0 },
    },
    supports: { html: false },
    edit: function ({ attributes, setAttributes }) {
      const blockProps = useBlockProps();
      const [options, setOptions] = useState([]);
      const [isLoading, setIsLoading] = useState(true);
      const typeLabel = attributes.contentType === "genre" ? "ジャンル" : "コラム";

      useEffect(function () {
        let isMounted = true;
        setIsLoading(true);
        apiFetch({
          path:
            "/buybuycoms-hobby/v1/internal-link-card-options?content_type=" +
            attributes.contentType,
        })
          .then(function (items) {
            if (isMounted) {
              setOptions(items);
            }
          })
          .catch(function () {
            if (isMounted) {
              setOptions([]);
            }
          })
          .finally(function () {
            if (isMounted) {
              setIsLoading(false);
            }
          });

        return function () {
          isMounted = false;
        };
      }, [attributes.contentType]);

      return el(
        "div",
        blockProps,
        el(
          InspectorControls,
          null,
          el(
            PanelBody,
            { title: __("リンク先設定", "buybuycoms-hobby"), initialOpen: true },
            el(SelectControl, {
              label: __("種類", "buybuycoms-hobby"),
              value: attributes.contentType,
              options: [
                { label: __("ジャンル", "buybuycoms-hobby"), value: "genre" },
                { label: __("コラム", "buybuycoms-hobby"), value: "column" },
              ],
              onChange: function (contentType) {
                setAttributes({ contentType: contentType, contentId: 0 });
              },
            }),
            isLoading
              ? el(Spinner)
              : el(ComboboxControl, {
                  label: typeLabel,
                  value: attributes.contentId ? String(attributes.contentId) : "",
                  options: options,
                  onChange: function (contentId) {
                    setAttributes({ contentId: Number(contentId) || 0 });
                  },
                  help: __(
                    "タイトルを入力して候補を検索できます。",
                    "buybuycoms-hobby",
                  ),
                }),
          ),
        ),
        attributes.contentId
          ? el(ServerSideRender, {
              block: "buybuycoms-hobby/internal-link-card",
              attributes: attributes,
            })
          : el(
              "p",
              null,
              __("サイドバーからリンク先を選択してください。", "buybuycoms-hobby"),
            ),
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
