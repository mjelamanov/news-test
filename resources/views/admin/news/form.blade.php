<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content']) !!}
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('picture') ? 'has-error' : ''}}">
    <label for="picture" class="control-label">{{ 'Picture' }}</label>
    {!! Form::file('picture', ['class' => 'form-control', 'id' => 'picture']) !!}
    {!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
