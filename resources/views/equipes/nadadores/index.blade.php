@extends('layouts.page')

@section('content')
	<div class="row">
		<div class="col-md-12">

			<tabs
			:tabs="[
			{'icon' : 'fa fa-list', 'title' : 'Lista de Registros', 'active' : false},
			{'icon' : 'fa fa-plus', 'title' : 'Adicionar Registro', 'active' : false},
			]"
			active-tab="{{$errors->any() ? 1 : 0}}"
			>

				<data-table slot="tabslot_0"
				title="Lista de Registros"
				busca="{{$busca}}"
				url="{{ $data['request']->url() }}"
				token="{{ csrf_token() }}"
				:items="{{ json_encode($items) }}"
				:titles="{{$titles}}"
				:actions="{{ $actions }}"
				:enable-delete="true"
				>

					@if(session()->has('message'))
						<div class="row">
							<div class="col-sm-12">
								<alert
								class="alert-success"
								icon="fa-check"
								text="{{ session()->get('message') }}">
								</alert>
							</div>
						</div>
					@endif

					<span slot="pagination" class="pull-right">
					{{ $items->links() }}
					</span>

				</data-table>

				<div slot="tabslot_1">

					<ui-form
					form-class="form-horizontal"
					title="Adicionar Registro"
					token="{{ csrf_token() }}"
					url="{{ route('equipes.nadadores.store', $equipeId) }}"
					method="POST">

						@if($errors->any())
						<div class="row">
							<div class="col-sm-12">
								<alert
								class="alert-danger"
								icon="fa-ban"
								title="Ops!"
								text="Não foi possível adicionar o registro, verifique os campos em destaque!">
								</alert>
							</div>
						</div>
						@endif
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-sm-2 control-label">Nome*</label>

							<div class="col-sm-10">
								<input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" maxlength="255" required>

								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }} {{ $errors->has('ano_nasc') ? ' has-error' : '' }}">
							<label for="cpf" class="col-sm-2 control-label">CPF*</label>

							<div class="col-sm-4">
								<input type="number" name="cpf" class="form-control" id="cpf" value="{{ old('cpf') }}" maxlength="255" required>

								@if ($errors->has('cpf'))
									<span class="help-block">
										<strong>{{ $errors->first('cpf') }}</strong>
									</span>
								@endif
							</div>

							<label for="ano_nasc" class="col-sm-2 control-label">Ano de Nascimento*</label>

							<div class="col-sm-4">
								<input type="number" name="ano_nasc" class="form-control" id="ano_nasc" value="{{ old('ano_nasc') }}" maxlength="255" required>

								@if ($errors->has('ano_nasc'))
									<span class="help-block">
										<strong>{{ $errors->first('ano_nasc') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</ui-form>
				</div>
			</tabs>
		</div>
	</div>

@endsection
