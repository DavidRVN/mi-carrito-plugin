// carrito.js

document.addEventListener("DOMContentLoaded", function () {
    let carritoLista = document.getElementById("mi-carrito-lista");
    let carritoTotal = document.getElementById("mi-carrito-total");

    function actualizarCarrito() {
        carritoLista.innerHTML = "";
        let total = 0;
        carritoData.forEach(item => {
            let li = document.createElement("li");

            li.innerHTML = `
                <span>${item.nombre} - $${item.precio}</span>
                <div class="item-controles">
                    <button class="cantidad-btn" onclick="cambiarCantidad(${item.id}, -1)">-</button>
                    <span class="cantidad">${item.cantidad}</span>
                    <button class="cantidad-btn" onclick="cambiarCantidad(${item.id}, 1)">+</button>
                    <button class="eliminar-btn" onclick="eliminarItem(${item.id})">❌</button>
                </div>
            `;

            carritoLista.appendChild(li);
            total += item.precio * item.cantidad;
        });
        carritoTotal.textContent = `$${total.toFixed(2)}`;
    }

    window.eliminarItem = function (id) {
        carritoData = carritoData.filter(item => item.id !== id);
        actualizarCarrito();
    }

    window.cambiarCantidad = function (id, cambio) {
        carritoData = carritoData.map(item => {
            if (item.id === id) {
                item.cantidad += cambio;
            }
            return item;
        }).filter(item => item.cantidad > 0); // elimina si llega a 0

        actualizarCarrito();
    }

    actualizarCarrito();

    if (!document.getElementById("finalizar-compra")) {
        const finalizarBtn = document.createElement("button");
        finalizarBtn.id = "finalizar-compra";
        finalizarBtn.textContent = "Finalizar compra";
        finalizarBtn.onclick = () => alert("Gracias por tu compra (simulado)");
        document.getElementById("mi-carrito-container").appendChild(finalizarBtn);
    }
});

//Bloque para obtener los datos del API productos
/*
fetch('/wp-json/mi-carrito/v1/productos')
  .then(res => res.json())
  .then(productos => {
    // transformar los datos si es necesario y renderizar
    const carritoData = productos.map(p => ({
      id: p.id,
      nombre: p.name,
      precio: parseFloat(p.price),
      cantidad: 1
    }));
    iniciarCarrito(carritoData);
  })
  .catch(err => console.error('Error cargando productos:', err));
*/