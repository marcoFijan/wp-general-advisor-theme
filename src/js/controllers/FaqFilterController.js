export default class FaqFiltersController {
  constructor(selector) {
    this.container = document.querySelector(selector);
    if (this.container) {
      this.allCb = this.container.querySelector('[data-faq-filter="all"]');
      this.specificCbs = this.container.querySelectorAll('[data-faq-filter="specific"]');
      this.faqItems = this.container.querySelectorAll("[data-faq-item]");
      this.init();
    }
  }

  init() {
    if (!this.faqItems.length) return;

    this.container.addEventListener("change", (e) => {
      const target = e.target;
      if (!target.hasAttribute("data-faq-filter")) return;

      const isAllTrigger = target === this.allCb;
      const checkedSpecifics = Array.from(this.specificCbs).filter((cb) => cb.checked);

      if (isAllTrigger) {
        if (this.allCb.checked) {
          this.specificCbs.forEach((cb) => (cb.checked = false));
        } else {
          if (checkedSpecifics.length === 0) this.allCb.checked = true;
        }
      } else {
        if (target.checked) {
          if (checkedSpecifics.length === this.specificCbs.length) {
            this.allCb.checked = true;
            this.specificCbs.forEach((cb) => (cb.checked = false));
          } else {
            if (this.allCb) this.allCb.checked = false;
          }
        } else {
          if (checkedSpecifics.length === 0 && this.allCb) {
            this.allCb.checked = true;
          }
        }
      }

      this.updateVisibility();
    });
  }

  updateVisibility() {
    const checkedValues = Array.from(this.specificCbs)
      .filter((cb) => cb.checked)
      .map((cb) => cb.value);

    const isAllChecked = this.allCb && this.allCb.checked;

    this.faqItems.forEach((item) => {
      if (isAllChecked || checkedValues.length === 0) {
        item.style.display = "";
        return;
      }

      const itemServices = item.getAttribute("data-faq-services");
      if (itemServices) {
        const servicesArray = itemServices.split(",").map((s) => s.trim());
        const hasMatch = servicesArray.some((service) => checkedValues.includes(service));
        item.style.display = hasMatch ? "" : "none";
      } else {
        item.style.display = "none";
      }
    });
  }
}
