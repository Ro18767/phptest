<div class="row">
	<form class="col s12" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s6">
				<i class="material-icons prefix">account_circle</i>
				<input id="reg-name" name="reg-name" type="text"
					class='<?= $form_data['reg-name']['class'] ?? 'validate' ?>'
					value='<?= $form_data['reg-name']['value'] ?? '' ?>'>
				<label for="reg-name">login</label>
				<?php if (isset($form_data['reg-name']['message']) && $form_data['reg-name']['message'] !== ''): ?>
					<span class="helper-text" data-error="<?= $form_data['reg-name']['message'] ?>"></span>
				<?php endif ?>
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">badge</i>
				<input id="reg-lastname" name="reg-lastname" type="text"
					class="<?= $form_data['reg-lastname']['class'] ?? 'validate' ?>"
					value="<?= $form_data['reg-lastname']['value'] ?? '' ?>">
				<label for="reg-lastname">Name</label>
				<?php if (isset($form_data['reg-lastname']['message']) && $form_data['reg-lastname']['message'] !== ''): ?>
					<span class="helper-text" data-error="<?= $form_data['reg-lastname']['message'] ?>"></span>
				<?php endif ?>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<i class="material-icons prefix">account_circle</i>
				<input id="reg-email" name="reg-email" type="email"
					class="<?= $form_data['reg-email']['class'] ?? 'validate' ?>"
					value="<?= $form_data['reg-email']['value'] ?? '' ?>">
				<label for="reg-email">Email</label>
				<?php if (isset($form_data['reg-email']['message']) && $form_data['reg-email']['message'] !== ''): ?>
					<span class="helper-text" data-error="<?= $form_data['reg-email']['message'] ?>"></span>
				<?php endif ?>
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">pin</i>
				<input id="reg-phone" name="reg-phone" type="password"
					class="<?= $form_data['reg-phone']['class'] ?? 'validate' ?>"
					value="<?= $form_data['reg-phone']['value'] ?? '' ?>">
				<label for="reg-phone">Telephone</label>
				<?php if (isset($form_data['reg-phone']['message']) && $form_data['reg-phone']['message'] !== ''): ?>
					<span class="helper-text" data-error="<?= $form_data['reg-phone']['message'] ?>"></span>
				<?php endif ?>
			</div>
		</div>

		<div class="row">
			<div class="file-field input-field">
				<div class="btn orange">
					<span>File</span>
					<input type="file" name="reg-avatar">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Виберіть Аватар">
				</div>
			</div>
		</div>
		<div class="row center-align">
			<button class="waves-effect waves-light btn orange darken-3">
				<i class="material-icons right">how_to_reg</i>Register
			</button>
		</div>
	</form>
</div>
<p>
	Особливості роботи з формами полягають у тому, що оновлення
	сторінки можи привести до повторної передачі даних. У разі
	POST запиту про це видається попередження, у разі GET - повтор
	автоматичний. Рекомендовано роботу з формами розділяти на
	два етапи: 1) прийом і оброблення даних та 2) відображення.
	Між цими етапами сервер передає браузеру редирект і зберігає
	дані у сесії. При повторному запиті дані відновлюються і
	відображаються.
</p>