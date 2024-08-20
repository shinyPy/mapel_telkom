## Authentication API Mapel_Skatel

### Base URL

```
http://base135-url.com/api
```

### Headers

- **Content-Type:** `application/json`

### Endpoints 

#### 1. Login

- **URL:** `/login`
- **Method:** `POST`
- **Description:** Autentikasi pengguna dengan mengirimkan username dan password, dan mendapatkan token akses JWT.

##### Request

```json
{
    "username": "string",  // Nama pengguna yang terdaftar
    "password": "string"   // Kata sandi yang terdaftar
}
```

##### Response

- **Success Response:**

  - **Code:** 200 OK
  - **Content:**
    ```json
    {
        "success": true,
        "user": {
            "id": "integer",
            "level": "string",
            "nama": "string",
            "username": "string",
            "foto": "string|null",
            // ... atribut lain dari model User
        },
        "accessToken": "string" // Token akses JWT
    }
    ```

- **Error Response:**

  - **Code:** 400 Bad Request (Jika validasi input gagal)
  - **Content:**
    ```json
    {
        "success": false,
        "error": {
            "field": ["Error message 1", "Error message 2"]
        }
    }
    ```

  - **Code:** 401 Unauthorized (Jika kredensial salah)
  - **Content:**
    ```json
    {
        "success": false,
        "message": "Username atau password salah!"
    }
    ```

#### 2. Register

- **URL:** `/register`
- **Method:** `POST`
- **Description:** Mendaftarkan pengguna baru ke dalam sistem.

##### Request

```json
{
    "level": "string",     // Level pengguna (misal: admin, user, dll.)
    "nama": "string",      // Nama lengkap pengguna
    "username": "string",  // Nama pengguna unik
    "foto": "string|null", // URL foto profil (opsional)
    "password": "string"   // Kata sandi
}
```

##### Response

- **Success Response:**

  - **Code:** 201 Created
  - **Content:**
    ```json
    {
        "success": true,
        "message": "Pengguna berhasil didaftarkan!",
        "user": {
            "id": "integer",
            "level": "string",
            "nama": "string",
            "username": "string",
            "foto": "string|null",
            // ... atribut lain dari model User
        }
    }
    ```

- **Error Response:**

  - **Code:** 400 Bad Request (Jika validasi input gagal)
  - **Content:**
    ```json
    {
        "success": false,
        "error": {
            "field": ["Error message 1", "Error message 2"]
        }
    }
    ```

### Notes

- Pastikan untuk menyertakan token akses JWT di header `Authorization: Bearer {token}` untuk semua endpoint yang membutuhkan autentikasi setelah login.

