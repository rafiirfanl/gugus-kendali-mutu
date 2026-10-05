<section>
    <p style="color: var(--crud-muted); font-size: 0.88rem; margin-bottom: 20px;">Ensure your account is using a long, random password to stay secure.</p>

    <form method="post" action="{{ route('password.update') }}" class="form-crud">
        @csrf
        @method('put')

        <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror"
                   autocomplete="current-password">
            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   autocomplete="new-password">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control"
                   autocomplete="new-password">
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn-crud btn-crud-primary">
                <i class="fas fa-save"></i> Save
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   style="font-size: 0.85rem; color: var(--crud-success); margin: 0;">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>