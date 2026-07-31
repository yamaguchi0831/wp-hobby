'use strict';

document
        .querySelectorAll(".hb-item-genre__p-faq-question")
        .forEach((button) => {
          button.addEventListener("click", () => {
            const item = button.closest(".hb-item-genre__p-faq-item");
            const isOpen = item.classList.toggle("hb-item-genre__is-open");
            button.setAttribute("aria-expanded", String(isOpen));
            button.querySelector(".hb-item-genre__p-faq-toggle").textContent =
              isOpen ? "－" : "＋";
          });
        });

const genreFaqMoreButton = document.querySelector("[data-hb-genre-faq-more]");

if (genreFaqMoreButton) {
  genreFaqMoreButton.addEventListener("click", () => {
    document
      .querySelectorAll("#genre-faq-list .hb-item-genre__p-faq-item[hidden]")
      .forEach((item) => {
        item.hidden = false;
      });

    genreFaqMoreButton.setAttribute("aria-expanded", "true");
    genreFaqMoreButton.closest(".hb-item-genre__p-faq-more").hidden = true;
  });
}

document
  .querySelectorAll("[data-hb-purchase-price-list]")
  .forEach((priceList) => {
    const priceItems = Array.from(priceList.children).filter((item) =>
      item.classList.contains("hb__p-price-group-item"),
    );
    const initialVisible = Number.parseInt(
      priceList.dataset.hbInitialVisible || "10",
      10,
    );
    const moreButton = document.querySelector(
      `[data-hb-purchase-price-more][aria-controls="${priceList.id}"]`,
    );

    if (!moreButton || initialVisible < 1 || priceItems.length <= initialVisible) {
      return;
    }

    const moreContainer = moreButton.closest(".hb__p-price-list-more");

    priceItems.slice(initialVisible).forEach((item) => {
      item.hidden = true;
    });

    if (moreContainer) {
      moreContainer.hidden = false;
    }

    moreButton.addEventListener("click", () => {
      priceItems.forEach((item) => {
        item.hidden = false;
      });
      moreButton.setAttribute("aria-expanded", "true");

      if (moreContainer) {
        moreContainer.hidden = true;
      }
    });
  });
