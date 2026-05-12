export default class VideoOverlayController {
  constructor(selector) {
    this.overlays = document.querySelectorAll(selector);
    this.init();
  }

  init() {
    this.overlays.forEach((el) => {
      el.addEventListener("click", (e) => {
        const currentTarget = e.currentTarget;
        const videoId = currentTarget.getAttribute("data-youtube-id");
        const iframe = this.createIframe(videoId);

        currentTarget.innerHTML = "";
        currentTarget.appendChild(iframe);
        currentTarget.classList.remove("cursor-pointer");
      });
    });

    // Load YouTube API
    const tag = document.createElement("script");
    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName("script")[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  }

  createIframe(videoId) {
    const iframe = document.createElement("iframe");
    iframe.src = `https://www.youtube.com/embed/${videoId}?enablejsapi=1&autoplay=1&rel=0`;
    iframe.frameBorder = "0";
    iframe.allow = "autoplay; encrypted-media";
    iframe.allowFullscreen = true;
    iframe.className = "absolute inset-0 w-full h-full";
    return iframe;
  }
}
