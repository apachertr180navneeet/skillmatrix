// Handle New Video Popup Modal
document.addEventListener("DOMContentLoaded", () => {
    const newPopup = document.getElementById("newVideoModal");
    const newVideo = document.getElementById("studentVideoPlayer");
    const closeBtn = document.getElementById("closeVideoModal");

    if (newPopup && newVideo && closeBtn) {
        document.querySelectorAll(".student-video-box").forEach(box => {
            box.addEventListener('click', () => {
                newVideo.src = box.getAttribute('data-video-src');
                newPopup.classList.add("show-modal");
                newVideo.play();
            });
        });

        const closeModal = () => {
            newPopup.classList.remove("show-modal");
            newVideo.pause();
            newVideo.src = "";
        };

        closeBtn.addEventListener('click', closeModal);

        newPopup.addEventListener('click', (e) => {
            if (e.target === newPopup || e.target.classList.contains('modal-backdrop-blur')) {
                closeModal();
            }
        });
    }
});