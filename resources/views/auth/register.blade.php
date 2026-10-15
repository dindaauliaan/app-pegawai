<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SEODash</title>
    @vite(['resources/css/register.css'])
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="logo-container">
                <div class="logo-circle">
                    <div class="logo-inner"></div>
                </div>
            </div>
            <h1 class="brand-name">SEODash</h1>
            <p class="brand-description">
                Sistem Manajemen Kepegawaian yang Modern dan Efisien. Kelola data pegawai, absensi, dan gaji dengan mudah.
            </p>
        </div>

        <div class="right-section">
            <div class="form-container">
                <form action="/register" method="POST">
                    @csrf 
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">👤</span>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="form-control" 
                                placeholder="Masukkan nama lengkap"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">@</span>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control" 
                                placeholder="nama@example.com"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-control" 
                                placeholder="Masukkan password"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="form-control" 
                                placeholder="Masukkan ulang password"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role">Daftar Sebagai</label>
                        <div class="input-wrapper select-wrapper">
                            <span class="input-icon">👥</span>
                            <select id="role" name="role" class="form-control" required>
                                <option value="employee">Employee</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">Register</button>
                    <div class="form-footer">
                        Sudah punya akun? <a href="/login">Login di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>