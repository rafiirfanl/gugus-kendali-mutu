<section>
    <p style="color: var(--crud-muted); font-size: 0.88rem; margin-bottom: 20px;">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>

    <button type="button" class="btn-crud btn-crud-danger"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        <i class="fas fa-trash"></i> Delete Account
    </button>

    <div x-data="{ open: false }" x-on:open-modal.window="open = $event.detail" x-on:close.window="open = false" x-show="open" x-transition style="display: none;">
        <div class="modal-backdrop fade show" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1040;" x-on:click="open = false"></div>
        <div class="modal fade show" style="display: block; z-index: 1050;" tabindex="-1">
            <div class="modal-dialog modal-crud" style="margin-top: 60px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-trash"></i> {{ __('Are you sure you want to delete your account?') }}</h5>
                        <button type="button" class="close" x-on:click="open = false" style="color: white;">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p style="color: var(--crud-muted); font-size: 0.88rem;">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>
                            <div class="form-crud" style="margin-top: 16px;">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                       placeholder="{{ __('Password') }}">
                                @error('password', 'userDeletion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-crud btn-crud-secondary" x-on:click="open = false">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn-crud btn-crud-danger">
                                <i class="fas fa-trash"></i> Delete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>