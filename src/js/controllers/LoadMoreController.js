export default class LoadMoreController {
  constructor(selector) {
    this.selector = selector;
    this.init();
  }

  init() {
    document.addEventListener("click", (e) => {
      const button = e.target.closest(this.selector);
      if (!button) return;

      e.preventDefault();

      const targetSelector = button.dataset.target;
      const container = document.querySelector(`[data-results="${targetSelector}"]`);

      if (!container) {
        console.warn(`Load more: no container found for [data-results="${targetSelector}"]`);
        return;
      }

      const page = parseInt(button.dataset.page);
      const maxPage = parseInt(button.dataset.max);
      const action = button.dataset.action;
      const filterValue = button.dataset.filterValue || "all";

      if (page >= maxPage) {
        button.closest(".flex.justify-center")?.classList.add("hidden");
        return;
      }

      button.classList.add("pointer-events-none", "opacity-50");
      const textSpan = button.querySelector("span.relative.z-10");
      const originalText = textSpan ? textSpan.innerText : "";
      if (textSpan) textSpan.innerText = "Laden...";

      const formData = new FormData();
      formData.append("action", action);
      formData.append("page", page + 1);
      formData.append("filter_value", filterValue);
      formData.append("nonce", site_vars.nonce);
      container.dataset.page = page + 1;

      fetch(site_vars.ajax_url, {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((html) => {
          if (html.trim().length > 0) {
            container.insertAdjacentHTML("beforeend", html);
            const newPage = page + 1;
            button.dataset.page = newPage;

            if (newPage >= maxPage) {
              button.closest(".flex.justify-center")?.classList.add("hidden");
            }
          } else {
            button.closest(".flex.justify-center")?.classList.add("hidden");
          }
        })
        .catch((error) => console.error("Load More Error:", error))
        .finally(() => {
          button.classList.remove("pointer-events-none", "opacity-50");
          if (textSpan) textSpan.innerText = originalText;
        });
    });
  }
}
