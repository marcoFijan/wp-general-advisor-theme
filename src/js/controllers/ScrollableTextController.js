export default class ScrollableTextController {
  constructor(selector) {
    this.containers = document.querySelectorAll(selector);
    this.init();
  }

  init() {
    this.containers.forEach((container) => {
      const words = container.querySelectorAll("[data-scroll-word]");
      if (words.length <= 1) return;

      let currentIndex = 0;

      setInterval(() => {
        const nextIndex = (currentIndex + 1) % words.length;
        const currentWord = words[currentIndex];
        const nextWord = words[nextIndex];

        currentWord.classList.remove("translate-y-0", "opacity-100");
        currentWord.classList.add("-translate-y-full", "opacity-0");

        nextWord.classList.remove("translate-y-full", "opacity-0");
        nextWord.classList.add("translate-y-0", "opacity-100");

        setTimeout(() => {
          currentWord.classList.remove("-translate-y-full");
          currentWord.classList.add("translate-y-full");
        }, 500);

        currentIndex = nextIndex;
      }, 3000);
    });
  }
}
