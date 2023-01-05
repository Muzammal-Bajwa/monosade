<form method="post" action="{{ route('coupons.store') }}">
    @csrf
     <div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <label for="name" class="col-form-label">{{__('Name')}}</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group col-md-6">
            <label for="discount" class="col-form-label">{{__('Discount')}}</label>
            <input type="number" name="discount" class="form-control" required step="0.01">
            <span class="small">{{__('Note: Discount in Percentage')}}</span>
        </div>
        <div class="form-group col-md-6">
            <label for="limit" class="col-form-label">{{__('Limit')}}</label>
            <input type="number" name="limit" class="form-control" required>
        </div>
    
<div class="form-group col-md-12" id="auto">
            {{Form::label('limit',__('Code') ,array('class'=>'col-form-label'))}}
            <div class="input-group">
                {{Form::text('code',null,array('class'=>'form-control','id'=>'auto-code','required'=>'required'))}}
                <button class="btn btn-outline-secondary" type="button" id="code-generate"><i class="fa fa-history pr-1"></i>{{__(' Generate')}}</button>
            </div>
        </div>
    </div>
</div>
        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close')}}</button>
             <input type="submit" value="{{ __('Save Changes')}}" class="btn  btn-primary">
        </div>
  
</form>
