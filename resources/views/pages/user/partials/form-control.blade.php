<div class="card-body">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') ?? $item->name }}">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="username" class="form-control" id="username" name="username" placeholder="username" value="{{ old('username') ?? $item->username }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') ?? $item->email }}">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="password" value="{{ old('password') ?? null }}">
    </div>
    <div class="form-group fg-role">
        <label for="roles">Roles</label>
        {!! Form::select('roles[]', $roles, $userRole ?? [], array('class' => 'form-control','multiple')) !!}
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Create' }}</button>
</div>