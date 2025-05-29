function toggleFilter(filterId) {
    let filterContent = document.getElementById(filterId);
    let arrowIcon = filterContent.previousElementSibling.querySelector(".arrow-icon");

    if (filterContent.classList.contains("hidden")) {
        filterContent.classList.remove("hidden");
        arrowIcon.innerHTML = "&#9660;"; // Down Arrow
    } else {
        filterContent.classList.add("hidden");
        arrowIcon.innerHTML = "&#9654;"; // Right Arrow
    }
}
