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
