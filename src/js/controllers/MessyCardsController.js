export default class MessyCardsController {
  constructor(selector) {
    this.grid = document.querySelector(selector);
    this.init();
  }

  init() {
    if (window.matchMedia("(max-width: 60.5rem)").matches) return;

    const items = this.grid.querySelectorAll("[data-card-item]");
    const total = items.length;

    items.forEach((card, i) => {
      let tx = "0px",
        ty,
        rot,
        scale;

      if (i === 0 || i === total - 1) {
        ty = "0px";
        rot = i === 0 ? "-3deg" : "3deg";
        scale = "0.92";
      } else {
        ty = (Math.random() * 60 - 30).toFixed(1) + "px";
        rot = (Math.random() * 10 - 5).toFixed(1) + "deg";
        scale = "1.08";
      }

      card.style.setProperty("--tx", tx);
      card.style.setProperty("--ty", ty);
      card.style.setProperty("--rot", rot);
      card.style.setProperty("--scale", scale);
    });

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            this.grid.classList.add("is-visible");
            observer.unobserve(this.grid);
          }
        });
      },
      { threshold: 0.7, rootMargin: "-15% 0px -15% 0px" },
    );

    observer.observe(this.grid);
  }
}
