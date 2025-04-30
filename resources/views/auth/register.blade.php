<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 15px;
      position: relative;
    }

    .register-box {
      width: 100%;
      max-width: 400px;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0,0,0,0.08);
      background-color: #fff;
      z-index: 1;
    }

    .btn-orange {
      background-color: orange;
      color: white;
    }

    .btn-orange:hover {
      background-color: darkorange;
    }

    .link-login {
      font-size: 12px;
      margin-top: 15px;
    }

    .footer-image, .header-image {
      position: absolute;
      width: 100%;
      max-height: 100px;
      object-fit: cover;
      z-index: 0;
    }

    .footer-image {
      bottom: 0;
    }

    .header-image {
      top: 0;
      transform: rotate(180deg);
    }

    @media (max-width: 576px) {
      .register-box {
        padding: 20px;
        box-shadow: none;
      }
    }

    .form-control:focus {
      border-color: orange;
      box-shadow: 0 0 0 0.25rem rgba(255, 165, 0, 0.25);
    }

    .alert {
      font-size: 14px;
    }
  </style>
</head>
<body>
  <!-- Gambar dekoratif atas (dibalik) -->
  <img src="{{ asset('images/elemen.png') }}" alt="Dekorasi Atas" class="header-image">

  <!-- Kotak register -->
  <div class="register-box text-center">
    <h4 class="fw-bold mb-4">REGISTER</h4>
    <form id="registerForm">
      @csrf
      <div class="mb-3 text-start">
        <label for="name" class="form-label">Nama :</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
        <div class="invalid-feedback" id="name-feedback"></div>
      </div>
      <div class="mb-3 text-start">
        <label for="email" class="form-label">Email :</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
        <div class="invalid-feedback" id="email-feedback"></div>
      </div>
      <div class="mb-3 text-start">
        <label for="password" class="form-label">Password :</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required>
        <div class="invalid-feedback" id="password-feedback"></div>
      </div>
      <div class="mb-3 text-start">
        <label for="password_confirmation" class="form-label">Konfirmasi Password :</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ketik ulang password" required>
        <div class="invalid-feedback" id="password_confirmation-feedback"></div>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-orange">Register</button>
      </div>
      <div class="text-center mt-3 link-login">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-orange">Login disini</a>
      </div>
    </form>
    <div id="message" class="mt-3"></div>
  </div>

  <!-- Gambar dekoratif bawah -->
  <img src="{{ asset('images/elemen.png') }}" alt="Dekorasi Bawah" class="footer-image">

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript untuk submit -->
  <script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      e.preventDefault();

      document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
      document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

      const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        password_confirmation: document.getElementById('password_confirmation').value,
        _token: document.querySelector('input[name="_token"]').value
      };

      fetch('{{ route("register.submit") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': formData._token
        },
        body: JSON.stringify(formData)
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(err => Promise.reject(err));
        }
        return response.json();
      })
      .then(data => {
        const messageDiv = document.getElementById('message');
        if (data.message) {
          messageDiv.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show">
              ${data.message}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
          document.getElementById('registerForm').reset();
          setTimeout(() => {
            window.location.href = '{{ route("login") }}';
          }, 2000);
        }
      })
      .catch(error => {
        const messageDiv = document.getElementById('message');

        if (error.errors) {
          for (const [field, messages] of Object.entries(error.errors)) {
            const input = document.getElementById(field);
            const feedback = document.getElementById(`${field}-feedback`);
            if (input && feedback) {
              input.classList.add('is-invalid');
              feedback.textContent = messages.join(', ');
            }
          }

          if (error.message) {
            messageDiv.innerHTML = `
              <div class="alert alert-danger alert-dismissible fade show">
                ${error.message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>`;
          }
        } else {
          messageDiv.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show">
              Terjadi kesalahan saat mendaftar. Silakan coba lagi.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
        }
      });
    });

    document.getElementById('password_confirmation').addEventListener('input', function() {
      const password = document.getElementById('password').value;
      const confirmation = this.value;
      const feedback = document.getElementById('password_confirmation-feedback');

      if (password !== confirmation && confirmation.length > 0) {
        this.classList.add('is-invalid');
        feedback.textContent = 'Konfirmasi password tidak sesuai';
      } else {
        this.classList.remove('is-invalid');
        feedback.textContent = '';
      }
    });
  </script>
</body>
</html>
