@extends('backend.layouts.master')

	@section('title','Update user')

	@section('content')

				<div class="span9">
                    <div class="content">
                    	@if(Session::has('message'))

                    		<div class="alert alert-success">
                    			{{Session::get('message')}}
                    		</div>

                    	@endif
                        <div class="module">
                            <div class="module-head">
                                <h3>Update User</h3>
                            </div>

                            <div class="module-body">
                            	<form action="{{route('user.update',[$user->id])}}" method="POST">@csrf
                                    {{method_field('PUT')}}

                            		<div class="control-group">
                            			<label class="control-lable">Full name</label>
                            			<div class="controls">
                            				<input type="text" name="name" class="span8 @error('name') border-red @enderror" placeholder="name" value="{{$user->name}}" >


                            			</div>
                                         @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                            		</div>




                                    <div class="control-group">
                                    <label class="control-lable" for="password">Password</label>
                                    <div class="controls">
                                        <input type="text" name="password" class="span8 @error('password') border-red @enderror" placeholder="password" value="" >
                                    </div>
                                     @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    </div>

                                    <div class="control-group">
                                        <label class="control-lable" for="email">Email</label>
                                        <div class="controls">
                                            <input type="text" name="email" class="span8 @error('question') border-red @enderror" placeholder="email" value="{{$user->email}}" >
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
									    <strong>{{ $message }}</strong>
									</span>
                                        @enderror


                                    <div class="control-group">
                                        <label class="control-lable" for="occupation">Phone</label>
                                        <div class="controls">
                                            <input type="number" name="phone" class="span8 @error('phone') border-red @enderror" placeholder="phone" value="{{$user->phone}}" >
                                        </div>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>



                                   <div class="control-group">
                                            <label class="control-lable" for="occupation">Is Admin</label>
                                            <div class="controls">
                                                <select name="is_admin">
                                                    <option value="1" {{($user->is_admin >0) ? "selected='selected": '' }}>Yes</option>
                                                    <option value="0"  {{($user->is_admin == 0) ? "selected='selected": '' }}>No</option>
                                                </select>
                                            </div>
                                   </div>


								<div class="control-group">
									<button type="submit" class="btn btn-success">Update User</button>

								</div>




                            </form>

                       		</div>
                   		</div>

                		</div>

           			</div>
        		</div>






@endsection
