const searchBar = document.querySelector('.search-bar');

searchBar.addEventListener('mouseover', () => {
    searchBar.style.transition = 'transform 0.3s ease';
    searchBar.style.transform = 'scale(1.05)';
});

searchBar.addEventListener('mouseout', () => {
    searchBar.style.transform = 'scale(1)';
});
