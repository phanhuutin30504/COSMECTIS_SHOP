<div class="form-group col-sm-4">
    <label for="province">Chọn tỉnh/thành phố</label>
    <select name="province" id="province" class="form-control">
        <option value="">Chọn tỉnh/thành phố</option>
        @foreach($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
        @endforeach
    </select>


    </select>
</div>
<div class="form-group col-sm-4">
    <label for="district">Chọn quận/huyện</label>
    <select name="district" id="district" class="form-control">
        <option value="">Chọn quận/huyện</option>
    </select>
</div>
<div class="form-group col-sm-4">
    <label for="ward">Chọn phường/xã</label>
<select name="ward" id="ward" class="form-control">
    <option value="">Chọn phường/xã</option>
</select>
</div>
<div class="form-group col-sm-12">
    <input type="text" value="{{$user->housenumber_street}}" class="form-control" placeholder="Địa chỉ" name="address" required="" >
</div>
