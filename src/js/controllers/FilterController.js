export default class FilterController {
  constructor(selector, options) {
    this.selector = selector;
    this.type = options.type; // 'cases' or 'news'
    this.filterButtons = document.querySelectorAll(this.selector);
    this.resultsGrid = document.querySelector(`[data-results="${this.type}-grid"]`);
    this.init();
  }

  init() {
    if (!this.filterButtons.length) return;

    this.filterButtons.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        this.runFilter(btn, btn.getAttribute("data-slug"));
      });
    });

    // Check URL on load
    const urlParams = new URLSearchParams(window.location.search);
    const paramKey = this.type === "cases" ? "sector" : "category";
    const initialSlug = urlParams.get(paramKey);

    if (initialSlug) {
      const activeBtn = Array.from(this.filterButtons).find((b) => b.getAttribute("data-slug") === initialSlug) || this.filterButtons[0];
      this.runFilter(activeBtn, initialSlug, true);
    }
  }

  updateURLParam(key, value) {
    const url = new URL(window.location.href);
    if (value && value !== "all") url.searchParams.set(key, value);
    else url.searchParams.delete(key);
    window.history.pushState({}, "", url);
  }

  runFilter(activeBtn, slug, isInitialLoad = false) {
    this.filterButtons.forEach((b) => {
      if (this.type === "cases") {
        b.classList.remove("bg-blue", "text-white");
        b.classList.add("bg-blue-light/50", "text-blue");
      } else {
        b.classList.remove("bg-blue", "text-white");
        b.classList.add("bg-white", "text-blue", "border-blue/10");
      }
    });

    if (this.type === "cases") {
      activeBtn.classList.add("bg-blue", "text-white");
      activeBtn.classList.remove("bg-blue-light/50", "text-blue");
    } else {
      activeBtn.classList.add("bg-blue", "text-white");
      activeBtn.classList.remove("bg-white", "text-blue", "border-blue/10");
    }

    if (!isInitialLoad) {
      this.updateURLParam(this.type === "cases" ? "sector" : "category", slug);
    }

    if (!this.resultsGrid) return;
    this.resultsGrid.style.opacity = "0.5";

    const formData = new FormData();
    formData.append("action", `filter_${this.type}`);
    formData.append("filter_value", slug);
    formData.append("nonce", site_vars.nonce); // Assuming site_vars is globally available

    fetch(site_vars.ajax_url, { method: "POST", body: formData })
      .then((res) => res.json())
      .then((data) => this.handleResponse(data, slug))
      .catch((err) => console.error(`${this.type} filter error:`, err));
  }

  handleResponse(data, slug) {
    this.resultsGrid.innerHTML = data.html;
    this.resultsGrid.style.opacity = "1";

    if (this.type === "cases") {
      const countDisplay = document.getElementById("case-count");
      if (countDisplay) countDisplay.innerText = data.total_found;
    }

    const loadMoreBtn = this.type === "news" ? document.querySelector('#news-load-more-container [data-logic="load-more"]') : document.querySelector('[data-logic="load-more"]');

    if (loadMoreBtn) {
      loadMoreBtn.dataset.page = 1;
      loadMoreBtn.dataset.max = data.max_pages;
      loadMoreBtn.dataset.filterValue = slug;

      const container = loadMoreBtn.closest(".flex.justify-center") || document.getElementById("news-load-more-container");
      if (container) container.classList.toggle("hidden", data.max_pages <= 1);
    }
  }
}
