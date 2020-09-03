<div class="form-group{{ $errors->has('news') ? 'has-error' : ''}}">
    <label for="news_id" class="control-label">{{ 'News' }}</label>
    {!! Form::select('news_id', $news, null, ['class' => 'form-control', 'id' => 'news_id']) !!}
    {!! $errors->first('news', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('comment') ? 'has-error' : ''}}">
    <label for="comment" class="control-label">{{ 'Comment' }}</label>
    {!! Form::textarea('comment', null, ['class' => 'form-control', 'id' => 'comment']) !!}
    {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
