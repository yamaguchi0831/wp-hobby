document.addEventListener("click", (event) => {
  const faqButton = event.target.closest("[data-hb-faq-question]");

  if (faqButton) {
    const item = faqButton.closest("article");

    if (!item) {
      return;
    }

    const isOpen = item.classList.toggle("hb__is-open");
    faqButton.setAttribute("aria-expanded", String(isOpen));

    const toggle = faqButton.lastElementChild;

    if (toggle) {
      toggle.textContent = isOpen ? "－" : "＋";
    }

    return;
  }

  const flowTab = event.target.closest("[data-flow-tab]");

  if (flowTab) {
    const section = flowTab.closest(".hb__p-flow");

    if (!section) {
      return;
    }

    const target = flowTab.dataset.flowTab;
    const tabs = section.querySelectorAll("[data-flow-tab]");
    const panels = section.querySelectorAll("[data-flow-panel]");

    tabs.forEach((item) => {
      const isActive = item === flowTab;
      item.classList.toggle("hb__is-active", isActive);
      item.setAttribute("aria-selected", String(isActive));
    });

    panels.forEach((panel) => {
      panel.hidden = panel.dataset.flowPanel !== target;
    });

    return;
  }

  const tab = event.target.closest(".hb__p-method-tab[data-method-tab]");

  if (!tab) {
    return;
  }

  const section = tab.closest(".hb__p-method--tabs");

  if (!section) {
    return;
  }

  const target = tab.dataset.methodTab;
  const tabs = section.querySelectorAll("[data-method-tab]");
  const panels = section.querySelectorAll("[data-method-panel]");

  tabs.forEach((item) => {
    const isActive = item === tab;
    item.classList.toggle("hb__is-active", isActive);
    item.setAttribute("aria-selected", String(isActive));
  });

  panels.forEach((panel) => {
    panel.classList.toggle(
      "hb__is-active",
      panel.dataset.methodPanel === target,
    );
  });
});
document.querySelectorAll("[data-hb-purchase-records]").forEach((grid) => {
  const cards = Array.from(grid.children).filter((card) =>
    card.classList.contains("hb__p-cases-card"),
  );
  const initialVisible = Number.parseInt(
    grid.dataset.hbInitialVisible || "0",
    10,
  );
  const moreButton = document.querySelector(
    `[data-hb-purchase-record-more][aria-controls="${grid.id}"]`,
  );

  if (!moreButton || initialVisible < 1 || cards.length <= initialVisible) {
    return;
  }

  cards.slice(initialVisible).forEach((card) => {
    card.hidden = true;
  });
  moreButton.hidden = false;

  moreButton.addEventListener("click", () => {
    cards.forEach((card) => {
      card.hidden = false;
    });
    moreButton.setAttribute("aria-expanded", "true");
    moreButton.hidden = true;
  });
});
