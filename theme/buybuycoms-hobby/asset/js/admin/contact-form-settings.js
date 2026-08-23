'use strict';

(() => {
  const tabGroup = document.querySelector('[data-hb-contact-detail-tabs]');
  if (!tabGroup) return;

  const tabs = [...tabGroup.querySelectorAll('[data-hb-contact-detail-tab]')];
  const panels = [...tabGroup.querySelectorAll('[data-hb-contact-detail-panel]')];

  const activate = (name) => {
    tabs.forEach((tab) => {
      const active = tab.dataset.hbContactDetailTab === name;
      tab.setAttribute('aria-selected', String(active));
      tab.classList.toggle('button-primary', active);
    });
    panels.forEach((panel) => {
      panel.hidden = panel.dataset.hbContactDetailPanel !== name;
    });
  };

  tabs.forEach((tab) => {
    tab.addEventListener('click', () => activate(tab.dataset.hbContactDetailTab));
    tab.addEventListener('keydown', (event) => {
      if (!['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(event.key)) return;

      event.preventDefault();
      const currentIndex = tabs.indexOf(tab);
      const nextIndex =
        event.key === 'Home'
          ? 0
          : event.key === 'End'
            ? tabs.length - 1
            : (currentIndex + (event.key === 'ArrowRight' ? 1 : -1) + tabs.length) % tabs.length;
      const nextTab = tabs[nextIndex];
      activate(nextTab.dataset.hbContactDetailTab);
      nextTab.focus();
    });
  });
})();
