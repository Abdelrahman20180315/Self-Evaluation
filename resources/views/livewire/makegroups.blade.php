<div>
<div class="card-body" >


    @if(Session()->has('message'))
      <div class="div alert alert-success">
        {{Session('message')}}
      </div>
      @endif

      @if(Session()->has('failure'))
      <div class="alert alert-danger">
        {{Session('failure')}}
      </div>
      @endif
      


        <form >
              
               <div class="row">
                    
                    <div style="text-align:right" class="col-md-12 mb-3">
                    <label>أسم المجموعة</label>
                        <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="group_name.0" required/>
                        @error('group_name.0')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>  
                    
                      
                    <div style="text-align:right" class="col-md-12 mb-3">
                    <label>وزن المجموعة</label>
                        <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="group_score.0" required/>
                        @error('group_score.0')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    
                      <div class="col-md-12 mb-3" >
                        <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$program_id}}"  wire:model="program_id.0" hidden/>
                    </div>
                    
                    <div style="text-align:right;" class="col-md-12 mb-3">
                        <button class="btn btn-primary mb-3" wire:click.prevent="add({{$i}})">إضافة مجموعة أخري</button>      
                        {{-- <input value="اضافه" style="background-color: crimson" type="submit" class="btn btn-primary"  name="image" /> --}}
                    </div>
                    {{-- Add Form --}}
                    @foreach ($inputs as $key => $value)
                       <div style="text-align:right" class="col-md-12 mb-3">
                        <label>أسم المجموعة</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"  wire:model="group_name.{{ $value }}" required/>
                            @error('group_name.')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>  
                        
                          
                        <div style="text-align:right" class="col-md-12 mb-3">
                        <label>وزن المجموعة</label>
                            <input type="text" style="background-color:OldLace;text-align:right" class="form-control"   wire:model="group_score.{{ $value }}" required/>
                            @error('group_score.')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        
                          {{-- <div class="col-md-12 mb-3" >
                            <input type="text"  style="background-color:OldLace;text-align:right" class="form-control" value="{{$group_id}}"  wire:model="group_id.{{ $value }}" hidden/>
                          </div> --}}
                        
                        <div style="text-align:right;" class="col-md-12 mb-3">

                            <button class="btn btn-light mb-3" wire:click.prevent="remove({{$key}})"><i class="bi bi-x"></i></button>
                        
                            {{-- <button class="btn btn-primary mb-3" wire:click.prevent="add({{$i}})"><i class="bi bi-plus"></i></button>       --}}
                            {{-- <input value="اضافه" style="background-color: crimson" type="submit" class="btn btn-primary"  name="image" /> --}}
                        </div>
                    @endforeach 
                    <div class="row">
                        <div class="col-12 ps-0">
                             <button type="button" class="btn btn-primary" style="background-color: red" wire:click.prevent="store()">Save</button>
                        </div>
                    </div>         
                </div>
        </form> 
</div>    
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            
            <h6 class="text-white text-capitalize ps-3">جدول المجموعات</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          @if(Session()->has('delete'))
            <div class="alert alert-danger">
              {{Session('delete')}}
            </div>
          @endif
          <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">أسم المجموعة</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">وزن المجموعة</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اكشن 1</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اكشن 2</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($groups as $group)
                <tr>
                  
                  <td>
                    <span class="text-xs font-weight-bold"><a href="{{url('/question/selectedgroup',$group->id)}}">{{$group->group_name}}</a></span>
                  </td>
                  <td>
                    <span class="text-xs font-weight-bold">{{$group->group_score}}</span>
                  </td>
                  <td>
                    <a href="{{route('group.edit', $group->id)}}" class="btn btn-success">Edit</a>
                  </td>
                  <td>
                    <form method="POST" action="{{route('group.destroy', $group->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>  
                      </form> 
                  </td>
                  
                </tr>
                @endforeach
            
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
</div>