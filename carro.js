let cart = [];

// Cargar los datos del carrito desde el servidor
async function fetchCart() {
    try {
        const response = await fetch('servidor.php');
        const data = await response.json();
        cart = data.items;
        updateCart();
    } catch (error) {
        console.error('Error al cargar el carrito:', error);
    }
}

// Actualizar la vista del carrito
function updateCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');
    const checkoutButton = document.getElementById('checkout-button');

    cartItemsContainer.innerHTML = '';
    let totalPrice = 0;

    cart.forEach(item => {
        const itemTotal = item.precio * item.cantidad;
        totalPrice += itemTotal;

        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <img src="${item.imagen || 'default.png'}" alt="Imagen del producto">
            <div>
                <strong>${item.nombre}</strong> - $${item.precio} x ${item.cantidad} = $${itemTotal.toFixed(2)}
                <div>
                    <button class="adjust-button" data-id="${item.producto_id}" data-action="add">+</button>
                    <button class="adjust-button" data-id="${item.producto_id}" data-action="subtract">-</button>
                    <button class="remove-button" data-id="${item.producto_id}">Eliminar</button>
                </div>
            </div>
        `;
        cartItemsContainer.appendChild(cartItem);
    });

    // Mostrar el total y el botón de checkout si hay productos en el carrito
    if (cart.length > 0) {
        totalPriceElement.style.display = 'block';
        totalPriceElement.innerText = `Precio Total: $${totalPrice.toFixed(2)}`;
        checkoutButton.style.display = 'block';
    } else {
        totalPriceElement.style.display = 'none';
        checkoutButton.style.display = 'none';
    }
}

// Manejo de eventos de clic (para ajustar cantidades o eliminar productos)
document.addEventListener('click', async (event) => {
    const button = event.target.closest('.adjust-button, .remove-button');
    if (!button) return;

    const productId = button.getAttribute('data-id');
    const item = cart.find(item => item.producto_id == productId);

    if (button.classList.contains('adjust-button')) {
        const action = button.getAttribute('data-action');
        let newQuantity = item.cantidad;

        // Cambiar la cantidad según el botón (+ o -)
        if (action === 'add') {
            newQuantity = item.cantidad + 1;
        } else if (action === 'subtract' && item.cantidad > 1) {
            newQuantity = item.cantidad - 1;
        }

        // Evitar cantidades no válidas
        if (newQuantity <= 0) return;

        // Actualizar la cantidad en el servidor
        try {
            const response = await fetch('servidor.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'update', product_id: productId, quantity: newQuantity }),
            });
            const data = await response.json();
            if (data.success) {
                item.cantidad = newQuantity;
                updateCart();
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error('Error al actualizar el carrito:', error);
        }
    }

    if (button.classList.contains('remove-button')) {
        // Eliminar producto del carrito
        try {
            const response = await fetch('servidor.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'delete', product_id: productId }),
            });
            const data = await response.json();
            if (data.success) {
                cart = cart.filter(item => item.producto_id != productId);
                updateCart();
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error('Error al eliminar producto del carrito:', error);
        }
    }
});

// Función para mostrar/ocultar el menú del carrito
document.getElementById('menu-toggle').addEventListener('click', () => {
    const cartMenu = document.getElementById('cart-menu');
    cartMenu.classList.toggle('show');
});

// Función para cerrar el menú del carrito
document.getElementById('close-menu').addEventListener('click', () => {
    document.getElementById('cart-menu').classList.remove('show');
});

// Iniciar la carga del carrito cuando se carga la página
fetchCart();
