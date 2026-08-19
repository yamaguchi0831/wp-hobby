(function (blocks, blockEditor, element, i18n, serverSideRender) {
  const { registerBlockType } = blocks;
  const { useBlockProps } = blockEditor;
  const { createElement: el } = element;
  const { __ } = i18n;
  const ServerSideRender = serverSideRender.default || serverSideRender;

  registerBlockType("buybuycoms-hobby/column-purchase-methods", {
    apiVersion: 2,
    title: __("買取方法（コラム用）", "buybuycoms-hobby"),
    description: __(
      "コラム本文内に、幅に応じてカード一覧とタブ表示を切り替える買取方法を挿入します。",
      "buybuycoms-hobby",
    ),
    icon: "screenoptions",
    category: "widgets",
    supports: {
      html: false,
    },
    edit: function () {
      const blockProps = useBlockProps();

      return el(
        "div",
        blockProps,
        el(ServerSideRender, {
          block: "buybuycoms-hobby/column-purchase-methods",
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
  window.wp.element,
  window.wp.i18n,
  window.wp.serverSideRender,
);
