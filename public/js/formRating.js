const stars = document.querySelectorAll('.star');
    const ratingValue = document.getElementById('ratingValue');

    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => {
            highlightStars(index);
        });

        star.addEventListener('mouseout', () => {
            resetStars();
        });

        star.addEventListener('click', () => {
            ratingValue.value = index + 1;
            setRating(index);
        });
    });

    function highlightStars(index) {
        stars.forEach((star, i) => {
            star.classList.toggle('hover', i <= index);
        });
    }

    function resetStars() {
        stars.forEach((star, i) => {
            star.classList.remove('hover');
            star.classList.toggle('selected', i < ratingValue.value);
        });
    }

    function setRating(index) {
        stars.forEach((star, i) => {
            star.classList.toggle('selected', i <= index);
        });
    }