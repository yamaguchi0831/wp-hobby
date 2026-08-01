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
  const defaultFilterId = grid.dataset.hbDefaultFilter || "";
  const moreButton = document.querySelector(
    `[data-hb-purchase-record-more][aria-controls="${grid.id}"]`,
  );
  const filterButtons = Array.from(
    document.querySelectorAll(
      `[data-hb-purchase-record-filter][aria-controls="${grid.id}"]`,
    ),
  );

  const updateCards = (filterId = "") => {
    const filteredCards = cards.filter((card) => {
      if (!card.hasAttribute("data-hb-purchase-record-card")) {
        return true;
      }

      if (!filterId) {
        return card.dataset.hbPurchaseRecordAll === "true";
      }

      return (card.dataset.hbPurchaseRecordTerms || "")
        .split(" ")
        .includes(filterId);
    });

    cards.forEach((card) => {
      card.hidden = !filteredCards.includes(card);
    });

    if (!moreButton || initialVisible < 1 || filteredCards.length <= initialVisible) {
      if (moreButton) {
        moreButton.hidden = true;
        moreButton.setAttribute("aria-expanded", "false");
      }
      return;
    }

    filteredCards.slice(initialVisible).forEach((card) => {
      card.hidden = true;
    });
    moreButton.hidden = false;
    moreButton.setAttribute("aria-expanded", "false");

    moreButton.onclick = () => {
      filteredCards.forEach((card) => {
        card.hidden = false;
      });
      moreButton.setAttribute("aria-expanded", "true");
      moreButton.hidden = true;
    };
  };

  if (!moreButton || initialVisible < 1) {
    return;
  }

  updateCards(defaultFilterId);

  filterButtons.forEach((filterButton) => {
    filterButton.addEventListener("click", () => {
      const filterId = filterButton.dataset.hbPurchaseRecordFilter || "";

      filterButtons.forEach((button) => {
        const isActive = button === filterButton;
        button.classList.toggle("hb__is-active", isActive);
        button.setAttribute("aria-pressed", String(isActive));
      });

      updateCards(filterId);
    });
  });
});
