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
