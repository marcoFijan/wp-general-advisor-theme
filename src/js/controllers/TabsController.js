export default class TabsController {
  constructor(selector) {
    this.selector = selector;
    this.init();
  }

  init() {
    document.querySelectorAll(this.selector).forEach((container) => {
      const triggers = Array.from(container.querySelectorAll(".tab-trigger"));
      const contents = Array.from(container.querySelectorAll(".tab-content"));

      triggers.forEach((trigger, index) => {
        trigger.addEventListener("click", () => {
          triggers.forEach((t, i) => t.setAttribute("aria-selected", String(i === index)));
          contents.forEach((c, i) => c.setAttribute("aria-hidden", String(i !== index)));
        });
      });
    });
  }
}
