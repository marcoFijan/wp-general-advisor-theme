export default class StepsTrackerController {
  constructor(selector) {
    this.containers = document.querySelectorAll(selector);
    this.init();
  }

  init() {
    this.containers.forEach((container) => {
      const stepCards = container.querySelectorAll("[data-step-card]");
      const trackers = container.querySelectorAll("[data-step-tracker]");

      if (!stepCards.length || !trackers.length) return;
      const visibleCards = new Set();

      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            const stepIndex = parseInt(entry.target.getAttribute("data-step"), 10);

            if (entry.isIntersecting) {
              visibleCards.add(stepIndex);
            } else {
              visibleCards.delete(stepIndex);
            }
          });

          if (visibleCards.size > 0) {
            const activeIndex = Math.max(...Array.from(visibleCards));

            trackers.forEach((t) => {
              t.classList.remove("opacity-100");
              t.classList.add("opacity-30");
            });

            const activeTracker = container.querySelector(`[data-step-tracker][data-step="${activeIndex}"]`);
            if (activeTracker) {
              activeTracker.classList.remove("opacity-30");
              activeTracker.classList.add("opacity-100");
            }
          }
        },
        { rootMargin: "-20% 0px -50% 0px" },
      );

      stepCards.forEach((card) => observer.observe(card));
    });
  }
}
