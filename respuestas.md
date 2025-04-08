
# Parte 1 - Preguntas Técnicas

## 1. CRUD en NestJS conectado a MongoDB

Para este CRUD usaría NestJS junto con Mongoose, conectando a una instancia de MongoDB.

### Estructura del CRUD:

- **Modelo**: Definido con `@Schema()` usando decoradores de Mongoose.
- **DTOs**: `CreateDto`, `UpdateDto` para validación de datos.
- **Service**: Contiene lógica de negocio y operaciones con MongoDB.
- **Controller**: Expone rutas REST (`POST`, `GET`, `PUT`, `DELETE`).

### Ejemplo de esquema:

```ts
@Schema()
export class Producto {
  @Prop({ required: true }) nombre: string;
  @Prop({ required: true }) precio: number;
  @Prop() descripcion?: string;
}
```

La conexión a MongoDB se realiza con `MongooseModule.forRoot()` en `AppModule`.

---

## 2. Diferencia entre Server-Side Rendering (SSR) y Static Site Generation (SSG) en Next.js

### SSR (Server-Side Rendering):

- La página se genera en **cada solicitud**.
- Contenido siempre actualizado.
- Útil para contenido dinámico (por ejemplo, usuarios logueados).

```ts
export async function getServerSideProps(context) {
  // lógica del servidor
  return { props: { ... } }
}
```

### SSG (Static Site Generation):

- La página se genera en **tiempo de build**.
- Ideal para contenido que no cambia frecuentemente (como un blog o landing page).

```ts
export async function getStaticProps() {
  // lógica estática
  return { props: { ... } }
}
```

---

## 3. ¿Cómo harías la autenticación en PHP y en .NET Core?

### En PHP:

- Uso de sesiones con `$_SESSION` o autenticación basada en JWT.
- En frameworks como Laravel: sistema de autenticación con middlewares, `sanctum` o `passport`.

### En .NET Core:

- Uso de `Identity`, autenticación por cookies o JWT para APIs.
- Configuración común:
```csharp
services.AddAuthentication(JwtBearerDefaults.AuthenticationScheme)
        .AddJwtBearer(options => {
            options.TokenValidationParameters = new TokenValidationParameters {
                ValidateIssuer = true,
                ValidateAudience = true,
                ValidateLifetime = true,
                ValidateIssuerSigningKey = true,
                // Más parámetros...
            };
        });
```
- Gestión de roles y permisos usando `[Authorize]` con Claims.