function loadMenu() {
    const search = document.getElementById('search-box').value;
    const category = document.getElementById('category-filter').value;
    const dietary = document.getElementById('dietary-filter').value;

    const url = `get_menu.php?search=${encodeURIComponent(search)}&category=${category}&dietary=${dietary}`;

    fetch(url)
        .then(res => res.json())
        .then(items => {
            const grid = document.getElementById('menu-grid');
            grid.innerHTML = '';

            if (items.length === 0) {
                grid.innerHTML = '<p>No dishes found.</p>';
                return;
            }

            items.forEach(item => {
                const card = document.createElement('div');
                card.className = 'menu-card';
                card.innerHTML = `
                    <div class="menu-card-img">${item.name.charAt(0)}</div>
                    <h3>${item.name}</h3>
                    <p class="desc">${item.description}</p>
                    <p class="tag">${item.dietary_type} · ${item.category_name}</p>
                    <p class="price">Rs. ${parseFloat(item.price).toFixed(2)}</p>
                    <button onclick="addToCart(${item.item_id})">Add to Cart</button>
                `;
                grid.appendChild(card);
            });
        });
}

document.getElementById('search-box').addEventListener('input', loadMenu);
document.getElementById('category-filter').addEventListener('change', loadMenu);
document.getElementById('dietary-filter').addEventListener('change', loadMenu);

loadMenu();