
# 🛒 Mi Carrito Plugin

Un plugin de carrito de compras simple para WordPress, con diseño responsivo tipo iOS y capacidad opcional de integrarse con la API de WooCommerce para mostrar productos dinámicamente.

---

## 🚀 Características

- Carrito básico y funcional.
- Diseño responsivo estilo iOS.
- Botones para aumentar/disminuir cantidad.
- Total calculado automáticamente.
- Soporte para mostrar productos desde un array o desde la API de WooCommerce (opcional).
- Integración sencilla mediante shortcode `[mi_carrito]`.

---

## 📦 Instalación

1. Clona este repositorio en la carpeta `/wp-content/plugins/`:

   ```bash
   git clone https://github.com/DavidRVN/mi-carrito-plugin.git
   ```

2. Activa el plugin desde el panel de administración de WordPress.

3. (Opcional) Si deseas utilizar la API de WooCommerce, asegúrate de que WooCommerce esté instalado y activo.

---

## 📁 Estructura de Archivos

```
mi-carrito-plugin/
│
├── assets/
│   ├── carrito.js         # Lógica del carrito en JavaScript
│   └── styles.css         # Estilos tipo iOS responsivos
│
├── includes/
│   └── api-productos.php  # [Opcional] Endpoint personalizado que conecta con WooCommerce
│
├── mi-carrito-plugin.php  # Archivo principal del plugin
└── README.md              # Este archivo
```

---

## 📜 Uso

Una vez activado el plugin, puedes añadir el carrito a cualquier página o entrada utilizando el siguiente shortcode:

```plaintext
[mi_carrito]
```

---

## 🔌 Integración con la API de WooCommerce (opcional)

1. **Instala WooCommerce** y genera claves API:  
   Ve a `WooCommerce > Ajustes > Avanzado > REST API`, y genera una clave con permisos de **lectura**.

2. **Configura `includes/api-productos.php`**  
   Define las claves en el archivo para permitir la conexión.

3. **Activa el endpoint**  
   El archivo expone la ruta:
   ```
   /wp-json/mi-carrito/v1/productos
   ```

4. **Modifica `carrito.js` para obtener productos dinámicamente**:
   ```javascript
   fetch('/wp-json/mi-carrito/v1/productos')
     .then(res => res.json())
     .then(productos => {
       const carritoData = productos.map(p => ({
         id: p.id,
         nombre: p.name,
         precio: parseFloat(p.price),
         cantidad: 1
       }));
       iniciarCarrito(carritoData);
     });
   ```

---

## 🎨 Estilo tipo iOS

- El widget ocupa todo el ancho disponible en móviles.
- Los botones son redondeados, accesibles y bien visibles.
- El total del carrito y las acciones se ajustan a pantallas pequeñas.

---

## 🧩 Personalización

- Personaliza los estilos editando `assets/styles.css`.
- Modifica la lógica del carrito en `assets/carrito.js`.

---

## 🧪 Versiones

| Versión | Estado     | Rama   |
|---------|------------|--------|
| 1.0.0   | Estable    | `main` |
| 1.1.0   | Desarrollo | `dev`  |
| 1.1.0   | Pruebas    | `test` |

---

## 🤝 Créditos

Creado por [David Rios](https://github.com/DavidRVN)

---

## 📄 Licencia

Este plugin está licenciado bajo la [Licencia MIT](LICENSE).