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
