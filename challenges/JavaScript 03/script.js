class Product {
    constructor(id, name, price, imageUrl) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.imageUrl = imageUrl;
        this.reviews = [];
    }

    addReview(rating, comment) {
        this.reviews.push({
            rating: rating,
            comment: comment,
            timestamp: new Date()
        });
    }

    getAverageRating() {
        if (this.reviews.length === 0) return 0;
        const sum = this.reviews.reduce((acc, review) => acc + review.rating, 0);
        return Math.round(sum / this.reviews.length);
    }
}

const products = [
    new Product(1, "Product 1", 10.00, "https://placehold.jp/150x150.png"),
    new Product(2, "Product 2", 20.00, "https://placehold.jp/150x150.png"),
    new Product(3, "Product 3", 25.00, "https://placehold.jp/150x150.png")
];

function renderProducts() {
    const productContainer = document.getElementById('product-container');
    productContainer.innerHTML = '';

    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.innerHTML = `
            <img src="${product.imageUrl}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>$${product.price.toFixed(2)}</p>
            <p>Rating: ${product.getAverageRating()}/5</p>
        `;
        productCard.addEventListener('click', () => openModal(product));
        productContainer.appendChild(productCard);
    });
}

function openModal(product) {
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modal-content');
    modalContent.innerHTML = `
        <h2>${product.name}</h2>
        <p>Rating: ${product.getAverageRating()}/5</p>
        <h3>Reviews:</h3>
        <div id="reviews-container"></div>
        <form id="review-form">
            <textarea id="review-comment" placeholder="Write your review"></textarea>
            <select id="review-rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit">Submit Review</button>
        </form>
    `;

    renderReviews(product);

    const form = document.getElementById('review-form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const comment = document.getElementById('review-comment').value;
        const rating = parseInt(document.getElementById('review-rating').value);
        product.addReview(rating, comment);
        renderReviews(product);
        renderProducts(); 
    });

    modal.style.display = 'block';
}

function renderReviews(product) {
    const reviewsContainer = document.getElementById('reviews-container');
    reviewsContainer.innerHTML = '';

    product.reviews.forEach(review => {
        const reviewElement = document.createElement('div');
        reviewElement.className = 'review';
        reviewElement.innerHTML = `
            <p>Rating: ${review.rating}/5</p>
            <p>${review.comment}</p>
            <small>${review.timestamp.toLocaleString()}</small>
        `;
        reviewsContainer.appendChild(reviewElement);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    renderProducts();

    const modal = document.getElementById('modal');
    const closeBtn = document.getElementsByClassName('close')[0];

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});