'use strict';

(() => {
        const form = document.querySelector("#hb-purchase-form");
        const blocks = Object.fromEntries(
          [...form.querySelectorAll("[data-block]")].map((block) => [
            block.dataset.block,
            block,
          ]),
        );
        const modal = document.querySelector("[data-modal]");
        const modalTitle = document.querySelector("[data-modal-title]");
        const modalBody = document.querySelector("[data-modal-body]");
        const modalActions = document.querySelector("[data-modal-actions]");
        const alertBox = form.querySelector("[data-alert]");
        const submitButton = form.querySelector(".hb__p-form__submit");
        const messageField = form.elements.message;
        const emailField = form.elements.customer_email;
        const telField = form.elements.customer_tel;
        const fieldErrors = Object.fromEntries(
          [...form.querySelectorAll("[data-field-error]")].map((error) => [
            error.dataset.fieldError,
            error,
          ]),
        );

        let selectedTakuhaiQty = "";
        let selectedShucchoQty = "";

        const messagePlaceholders = {
          takuhai:
            "※簡単で構いませんので商品の内容や量をお教えください。\n※自分の箱で送る場合は送り状の必要枚数もご記入ください。\n\n例：プラモデル100点\nフィギュアがみかん箱で10箱分など、おおよその内容と全体量をお知らせください。\n\n全体量が分かるお写真を添付していただく形でも結構です。",
          shuccho:
            "※簡単で構いませんので商品の内容や量をお教えください。\n\n例：\n6畳部屋の中にぎっしり詰まっている\nプラモデル100点\nフィギュアがみかん箱で10箱分など、おおよその内容と全体量をお知らせください。\n\n全体量が分かるお写真を添付していただく形でも結構です。",
          mochikomi:
            "※簡単で構いませんので商品の内容や量をお教えください。\n※自分の箱で送る場合は送り状の必要枚数もご記入ください。\n\n例：プラモデル100点\nフィギュアがみかん箱で10箱分など、おおよその内容と全体量をお知らせください。\n\n全体量が分かるお写真を添付していただく形でも結構です。",
        };

        const requiredByBlock = {
          "takuhai-qty": ["takuhai_qty"],
          "shuccho-qty": ["shuccho_qty"],
          "box-prep": ["box_prep"],
          "shuccho-date": ["shuccho_date_1", "shuccho_time_1"],
          customer: [
            "customer_name",
            "customer_email",
            "customer_address",
            "customer_tel",
            "agreement",
          ],
        };

        const hideBlock = (name) => {
          const block = blocks[name];
          if (!block) return;
          block.hidden = true;
          block.querySelectorAll("input, select, textarea").forEach((field) => {
            field.required = false;
            field.disabled = true;
          });
          updateSubmitState();
        };

        const showBlock = (name) => {
          const block = blocks[name];
          if (!block) return;
          block.hidden = false;
          block.querySelectorAll("input, select, textarea").forEach((field) => {
            field.disabled = false;
          });
          (requiredByBlock[name] || []).forEach((fieldName) => {
            block.querySelectorAll(`[name="${fieldName}"]`).forEach((field) => {
              field.required = true;
            });
          });
          updateSubmitState();
        };

        const resetAfterMethod = () => {
          [
            "takuhai-qty",
            "shuccho-qty",
            "box-prep",
            "kit",
            "shuccho-date",
            "mochikomi-date",
            "customer",
          ].forEach(hideBlock);
          hideAlert();
        };

        const resetAfterTakuhaiQty = () => {
          ["box-prep", "kit", "customer"].forEach(hideBlock);
          hideAlert();
        };

        const resetAfterShucchoQty = () => {
          ["shuccho-date", "customer"].forEach(hideBlock);
          hideAlert();
        };

        const hideAlert = () => {
          alertBox.hidden = true;
          alertBox.textContent = "";
        };

        const updateSubmitState = () => {
          const agreement = form.elements.agreement;
          submitButton.disabled =
            !agreement || agreement.disabled || !agreement.checked;
        };

        const showAlert = (message) => {
          alertBox.textContent = message;
          alertBox.hidden = false;
          alertBox.scrollIntoView({
            behavior: "smooth",
            block: "center",
          });
        };

        const toHalfWidthNumber = (value) =>
          value.replace(/[０-９]/g, (char) =>
            String.fromCharCode(char.charCodeAt(0) - 0xfee0),
          );

        const setFieldError = (field, message) => {
          const error = fieldErrors[field.name];
          field.setCustomValidity(message);
          if (!error) return;
          error.textContent = message;
          error.hidden = !message;
        };

        const validateTel = () => {
          const value = telField.value.trim();
          if (!value) {
            setFieldError(telField, "");
            return true;
          }
          const telMessage = "正しい電話番号を入力して下さい。";
          const allowedChars = /^[0-9０-９\-－]+$/;
          const normalized = toHalfWidthNumber(value).replace(/[\-－]/g, "");
          const isValid =
            allowedChars.test(value) &&
            (normalized.length === 10 || normalized.length === 11) &&
            normalized.startsWith("0") &&
            !/^(\d)\1+$/.test(normalized);
          setFieldError(telField, isValid ? "" : telMessage);
          return isValid;
        };

        const validateEmail = () => {
          const value = emailField.value.trim();
          if (!value) {
            setFieldError(emailField, "");
            return true;
          }
          const emailMessage = "正しいメールアドレスを入力して下さい。";
          const atCount = (value.match(/@/g) || []).length;
          const [local, domain] = value.split("@");
          const hasFullWidth = /[^\x00-\x7f]/.test(value);
          const isValid =
            atCount === 1 &&
            Boolean(local) &&
            Boolean(domain) &&
            domain.includes(".") &&
            !hasFullWidth;
          setFieldError(emailField, isValid ? "" : emailMessage);
          return isValid;
        };

        const validateContactFields = () => {
          const isEmailValid = validateEmail();
          const isTelValid = validateTel();
          return isEmailValid && isTelValid;
        };

        const setMessagePlaceholder = (type) => {
          if (!messageField || !messagePlaceholders[type]) return;
          messageField.placeholder = messagePlaceholders[type];
        };

        const setNotes = (type) => {
          document.querySelectorAll("[data-notes]").forEach((notes) => {
            notes.hidden = notes.dataset.notes !== type;
          });
          setMessagePlaceholder(type);
        };

        const openModal = ({ title, body, actions }) => {
          modalTitle.textContent = title;
          modalBody.innerHTML = body;
          modalActions.replaceChildren(...actions);
          modal.hidden = false;
        };

        const closeModal = () => {
          modal.hidden = true;
          modalTitle.textContent = "";
          modalBody.replaceChildren();
          modalActions.replaceChildren();
        };

        const modalButton = (text, className, onClick) => {
          const button = document.createElement("button");
          button.type = "button";
          button.className = className;
          button.textContent = text;
          button.addEventListener("click", onClick);
          return button;
        };

        const scrollToBlock = (name) => {
          blocks[name]?.scrollIntoView({
            behavior: "smooth",
            block: "start",
          });
        };

        const getCheckedValue = (name) =>
          form.querySelector(`[name="${name}"]:checked`)?.value || "";

        const showCustomer = (type) => {
          setNotes(type);
          showBlock("customer");
          scrollToBlock("customer");
        };

        const restoreTakuhaiBlocks = () => {
          const quantity = getCheckedValue("takuhai_qty");
          if (quantity !== "over") return;
          showBlock("box-prep");
          const boxPrep = getCheckedValue("box_prep");
          if (boxPrep === "kit") {
            showBlock("kit");
            setNotes("takuhai");
            showBlock("customer");
          }
          if (boxPrep === "self") {
            setNotes("takuhai");
            showBlock("customer");
          }
        };

        const restoreShucchoBlocks = () => {
          const quantity = getCheckedValue("shuccho_qty");
          if (quantity !== "over") return;
          showBlock("shuccho-date");
          setNotes("shuccho");
          showBlock("customer");
        };

        const handleMethod = (type) => {
          resetAfterMethod();
          if (type === "takuhai") {
            showBlock("takuhai-qty");
            restoreTakuhaiBlocks();
            scrollToBlock("takuhai-qty");
          }
          if (type === "shuccho") {
            showBlock("shuccho-qty");
            restoreShucchoBlocks();
            scrollToBlock("shuccho-qty");
          }
          if (type === "mochikomi") {
            showBlock("mochikomi-date");
            setNotes("mochikomi");
            showBlock("customer");
            scrollToBlock("mochikomi-date");
          }
        };

        const handleTakuhaiQty = (value) => {
          resetAfterTakuhaiQty();
          if (value === "under") {
            openModal({
              title: "商品点数が10点未満の場合",
              body: '<p>商品点数が10点未満の場合、まずは事前査定をお願いいたします。</p><div class="hb__p-form-modal__links"><a class="hb__p-form-modal__text-link" href="tel:0120000000">電話査定はこちら</a><a class="hb__p-form-modal__text-link" href="https://line.me/R/ti/p/@081xadbs">LINE写真査定はこちら</a></div>',
              actions: [
                modalButton("閉じる", "hb__p-form-modal__close", closeModal),
              ],
            });
            return;
          }
          openModal({
            title: "宅配買取のご確認",
            body: '<ul class="hb__p-form-modal__list"><li>未成年の方のご利用はできません。</li><li>査定合計5,000円未満時、送料無料対象外です。</li><li>プラモデルの完成品のみの場合は30点以上から受付可能です。</li><li>完成品は品物の特性上、買取キャンセルおよび返送対応を致しかねます。</li></ul>',
            actions: [
              modalButton(
                "上記を確認しました",
                "hb__c-btn hb__c-btn--primary hb__p-form-modal__button",
                () => {
                  closeModal();
                  showBlock("box-prep");
                  scrollToBlock("box-prep");
                },
              ),
            ],
          });
        };

        const handleShucchoQty = (value) => {
          resetAfterShucchoQty();
          if (value === "under") {
            openModal({
              title: "出張買取について",
              body: '<p>箱数が4箱以下の場合は出張買取の対応が難しいため、申し訳御座いませんが宅配買取か店頭買取をご利用下さい。</p><div class="hb__p-form-modal__links"><a class="hb__p-form-modal__text-link" href="#purchase-form" data-select-type="takuhai">宅配買取はこちら</a><a class="hb__p-form-modal__text-link" href="#purchase-form" data-select-type="mochikomi">店頭買取はこちら</a></div>',
              actions: [
                modalButton("閉じる", "hb__p-form-modal__close", closeModal),
              ],
            });
            return;
          }
          openModal({
            title: "出張エリアについて",
            body: '<ul class="hb__p-form-modal__list"><li>出張エリアは関西圏のみとなります。</li><li>関西圏以外の場合は宅配買取をお選びください。</li></ul><div class="hb__p-form-modal__links"><a class="hb__p-form-modal__text-link" href="#purchase-form" data-select-type="takuhai">宅配買取はこちら</a></div>',
            actions: [
              modalButton(
                "上記を確認しました",
                "hb__c-btn hb__c-btn--primary hb__p-form-modal__button",
                () => {
                  closeModal();
                  showBlock("shuccho-date");
                  setNotes("shuccho");
                  showBlock("customer");
                  scrollToBlock("shuccho-date");
                },
              ),
            ],
          });
        };

        const handleBoxPrep = (value) => {
          hideBlock("kit");
          hideBlock("customer");
          setNotes("takuhai");
          if (value === "kit") {
            showBlock("kit");
            showBlock("customer");
            scrollToBlock("kit");
            return;
          }
          showCustomer("takuhai");
        };

        form.addEventListener("change", (event) => {
          const field = event.target;
          if (field instanceof HTMLInputElement && field.name === "agreement")
            updateSubmitState();
          if (!(field instanceof HTMLInputElement)) return;
          if (field.name === "purchase_type") handleMethod(field.value);
          if (field.name === "takuhai_qty") {
            selectedTakuhaiQty = field.value;
            handleTakuhaiQty(field.value);
          }
          if (field.name === "shuccho_qty") {
            selectedShucchoQty = field.value;
            handleShucchoQty(field.value);
          }
          if (field.name === "box_prep") handleBoxPrep(field.value);
        });

        form.querySelectorAll('[name="takuhai_qty"]').forEach((input) => {
          input.addEventListener("click", () => {
            if (input.value === selectedTakuhaiQty)
              handleTakuhaiQty(input.value);
          });
        });
        form.querySelectorAll('[name="shuccho_qty"]').forEach((input) => {
          input.addEventListener("click", () => {
            if (input.value === selectedShucchoQty)
              handleShucchoQty(input.value);
          });
        });

        emailField.addEventListener("blur", validateEmail);
        telField.addEventListener("blur", validateTel);

        modal.addEventListener("click", (event) => {
          const selectTypeLink = event.target.closest("[data-select-type]");
          if (selectTypeLink) {
            event.preventDefault();
            const type = selectTypeLink.dataset.selectType;
            const radio = form.querySelector(
              `[name="purchase_type"][value="${type}"]`,
            );
            if (radio) {
              closeModal();
              radio.checked = true;
              handleMethod(type);
            }
            return;
          }
          if (event.target === modal) closeModal();
        });

        form.addEventListener("submit", (event) => {
          hideAlert();
          const selectedMethod = getCheckedValue("purchase_type");
          const boxPrep = form.elements.box_prep?.value;
          if (selectedMethod === "takuhai" && boxPrep === "kit") {
            const total = ["box_s", "box_m", "box_l", "box_ll"].reduce(
              (sum, name) => {
                return sum + Number(form.elements[name].value || 0);
              },
              0,
            );
            if (total < 1) {
              event.preventDefault();
              showAlert(
                "買取キットを請求する場合は、段ボールを1枚以上選択してください。",
              );
              return;
            }
          }

          if (!validateContactFields()) {
            event.preventDefault();
            form.querySelector(":invalid")?.scrollIntoView({
              behavior: "smooth",
              block: "center",
            });
            return;
          }

          if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
          }

          // Client-side validation has passed. Submit to the server for validation and delivery.
        });

        const params = new URLSearchParams(window.location.search);
        const requestedType =
          params.get("type") || window.location.hash.replace("#", "");
        if (["takuhai", "shuccho", "mochikomi"].includes(requestedType)) {
          const radio = form.querySelector(
            `[name="purchase_type"][value="${requestedType}"]`,
          );
          radio.checked = true;
          handleMethod(requestedType);
        } else {
          [
            "takuhai-qty",
            "shuccho-qty",
            "box-prep",
            "kit",
            "shuccho-date",
            "mochikomi-date",
            "customer",
          ].forEach(hideBlock);
        }
      })();
