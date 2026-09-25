const activateMethodTab = (section, target) => {
  const tabs = section.querySelectorAll("[data-method-tab]");
  const panels = section.querySelectorAll("[data-method-panel]");
  const activeTab = Array.from(tabs).find(
    (tab) => tab.dataset.methodTab === target,
  );

  if (!activeTab) {
    return false;
  }

  tabs.forEach((item) => {
    const isActive = item === activeTab;
    item.classList.toggle("hb__is-active", isActive);
    item.setAttribute("aria-selected", String(isActive));
  });

  panels.forEach((panel) => {
    panel.classList.toggle(
      "hb__is-active",
      panel.dataset.methodPanel === target,
    );
  });

  return true;
};

const initializeMobileHeaderMenu = () => {
  const menuButton = document.querySelector("[data-hb-mobile-menu-toggle]");
  const drawer = document.querySelector(".hb__p-header-drawer");
  const overlay = document.querySelector(".hb__p-header-drawer__overlay");

  if (!menuButton || !drawer || !overlay) {
    return;
  }

  let lastFocusedElement = null;

  const setMenuState = (isOpen, restoreFocus = true) => {
    menuButton.setAttribute("aria-expanded", String(isOpen));
    menuButton.setAttribute(
      "aria-label",
      isOpen ? "メニューを閉じる" : "メニューを開く",
    );
    drawer.setAttribute("aria-hidden", String(!isOpen));
    drawer.toggleAttribute("inert", !isOpen);
    overlay.setAttribute("aria-hidden", String(!isOpen));
    document.body.classList.toggle("hb__is-mobile-menu-open", isOpen);

    if (isOpen) {
      lastFocusedElement = document.activeElement;
      const firstMenuLink = drawer.querySelector("nav a");
      (firstMenuLink || drawer.querySelector("button"))?.focus();
    } else if (restoreFocus && lastFocusedElement instanceof HTMLElement) {
      lastFocusedElement.focus();
    }
  };

  menuButton.addEventListener("click", () => {
    setMenuState(menuButton.getAttribute("aria-expanded") !== "true");
  });

  document.querySelectorAll("[data-hb-mobile-menu-close]").forEach((element) => {
    element.addEventListener("click", () => setMenuState(false));
  });

  drawer.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => setMenuState(false, false));
  });

  document.addEventListener("keydown", (event) => {
    if (
      event.key === "Escape" &&
      menuButton.getAttribute("aria-expanded") === "true"
    ) {
      setMenuState(false);
    }
  });

  const desktopMedia = window.matchMedia("(min-width: 961px)");
  desktopMedia.addEventListener("change", (event) => {
    if (event.matches && menuButton.getAttribute("aria-expanded") === "true") {
      setMenuState(false, false);
    }
  });
};

initializeMobileHeaderMenu();

const getHashTarget = (hash) => {
  if (!hash) {
    return null;
  }

  try {
    return document.getElementById(decodeURIComponent(hash.slice(1)));
  } catch (error) {
    return null;
  }
};

const activateMethodTabForTarget = (targetElement) => {
  if (!targetElement) {
    return false;
  }

  const panel = targetElement.closest("[data-method-panel]");
  const section = panel?.closest(".hb__p-method--tabs");

  if (!panel || !section) {
    return false;
  }

  return activateMethodTab(section, panel.dataset.methodPanel);
};

const revealMethodTabForHash = () => {
  const targetElement = getHashTarget(window.location.hash);

  if (!activateMethodTabForTarget(targetElement)) {
    return;
  }

  window.requestAnimationFrame(() => {
    targetElement.scrollIntoView({ block: "start" });
  });
};

document.addEventListener(
  "click",
  (event) => {
    const link = event.target.closest('a[href*="#"]');

    if (!link) {
      return;
    }

    const linkUrl = new URL(link.href, window.location.href);
    const isCurrentPage =
      linkUrl.origin === window.location.origin &&
      linkUrl.pathname === window.location.pathname &&
      linkUrl.search === window.location.search;

    if (isCurrentPage) {
      activateMethodTabForTarget(getHashTarget(linkUrl.hash));
    }
  },
  true,
);

window.addEventListener("hashchange", revealMethodTabForHash);
revealMethodTabForHash();

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

  activateMethodTab(section, tab.dataset.methodTab);
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
