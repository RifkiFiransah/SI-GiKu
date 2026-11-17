<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script>
    document.querySelectorAll('.modal form').forEach(function (form) {
        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            const submit = form.querySelector('[type="submit"]');
            const originalLabel = submit ? submit.textContent : '';
            if (submit) {
                submit.disabled = true;
                submit.textContent = 'Menyimpan...';
            }

            form.querySelectorAll('.modal-submit-error').forEach(function (node) {
                node.remove();
            });
            form.querySelectorAll('.is-invalid').forEach(function (node) {
                node.classList.remove('is-invalid');
            });

            const token = form.querySelector('input[name="_token"]');
            const headers = {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            };
            if (token) {
                headers['X-CSRF-TOKEN'] = token.value;
            }

            try {
                const response = await fetch(form.action, {
                    method: (form.method || 'post').toUpperCase(),
                    body: new FormData(form),
                    headers: headers,
                    credentials: 'same-origin'
                });

                if (response.ok || response.redirected) {
                    window.location.assign(response.url);
                    return;
                }

                if (response.status === 422) {
                    const payload = await response.json();
                    Object.keys(payload.errors || {}).forEach(function (field) {
                        const input = form.querySelector('[name="' + field + '"]:not([type="hidden"])') || form.querySelector('[name="' + field + '"]');
                        if (!input) {
                            return;
                        }

                        input.classList.add('is-invalid');
                        const message = document.createElement('div');
                        message.className = 'invalid-feedback d-block modal-submit-error';
                        message.setAttribute('role', 'alert');
                        message.textContent = (payload.errors[field] || []).join(' ');
                        input.insertAdjacentElement('afterend', message);
                    });

                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.focus();
                    }
                    return;
                }

                throw new Error('Request failed');
            } catch (error) {
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger modal-submit-error';
                alert.setAttribute('role', 'alert');
                alert.textContent = 'Data gagal disimpan. Periksa kembali input lalu coba lagi.';
                form.querySelector('.modal-body').prepend(alert);
            } finally {
                if (submit) {
                    submit.disabled = false;
                    submit.textContent = originalLabel;
                }
            }
        });
    });
</script>
@stack('scripts')
