@role('admin')
You dont have access to this Admin page.
<a href="{{ route('admin.index') }}" class="btn btn-primary">Kembali ke Dashboard Admin</a>
@endrole

@role('user')
You dont have access to this User page.
<a href="{{ route('user.index') }}" class="btn btn-primary">Kembali ke Dashboard User</a>
@endrole