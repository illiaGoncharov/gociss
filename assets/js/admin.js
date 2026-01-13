/**
 * Toggle-модули для ACF полей в админке
 */
(function($) {
	'use strict';

	function initToggleGroups() {
		// Конфигурация: тип -> { заголовок, поля, главное поле }
		var configs = {
			'service': { title: 'Услуга', fields: ['icon', 'title', 'desc', 'link'], main: 'title' },
			'advantage': { title: 'Преимущество', fields: ['icon', 'text'], main: 'text' },
			'expert': { title: 'Эксперт', fields: ['photo', 'name', 'position', 'experience'], main: 'name' },
			'faq': { title: 'Вопрос', fields: ['question', 'answer'], main: 'question' },
			'sfaq': { title: 'Вопрос', fields: ['question', 'answer'], main: 'question' }
		};

		$.each(configs, function(type, config) {
			for (var i = 1; i <= 8; i++) {
				var prefix = 'gociss_' + type + '_' + i + '_';
				var $fieldsList = [];
				var mainValue = '';

				// Собираем все поля группы
				config.fields.forEach(function(fieldName) {
					var $field = $('.acf-field[data-name="' + prefix + fieldName + '"]');
					if ($field.length) {
						$fieldsList.push($field);
						// Получаем значение главного поля
						if (fieldName === config.main) {
							var $input = $field.find('input[type="text"], textarea').first();
							var val = $input.val();
							if (val && val.trim()) {
								mainValue = val.substring(0, 40);
								if (val.length > 40) mainValue += '...';
							}
						}
					}
				});

				// Если поля не найдены — пропускаем
				if ($fieldsList.length === 0) continue;

				// Проверяем, не обработана ли уже группа
				if ($fieldsList[0].parent().hasClass('gociss-toggle-content')) continue;

				// Создаём структуру toggle
				var hasData = mainValue !== '';
				var statusText = hasData ? '✓ ' + mainValue : '(пусто)';

				var $group = $('<div class="gociss-toggle-group"></div>');
				var $header = $(
					'<div class="gociss-toggle-header">' +
						'<span class="toggle-title">' + config.title + ' ' + i + 
							'<span class="toggle-status">' + statusText + '</span>' +
						'</span>' +
						'<span class="toggle-arrow">▼</span>' +
					'</div>'
				);
				var $content = $('<div class="gociss-toggle-content"></div>');

				// Вставляем группу перед первым полем
				$fieldsList[0].before($group);

				// Перемещаем поля в контент
				$fieldsList.forEach(function($f) {
					$content.append($f);
				});

				// Собираем структуру
				$group.append($header);
				$group.append($content);

				// Обработчик клика
				$header.on('click', function() {
					var $g = $(this).closest('.gociss-toggle-group');
					$g.toggleClass('is-open');
				});
			}
		});
	}

	// Запуск
	$(document).ready(function() {
		// Небольшая задержка для загрузки ACF
		setTimeout(initToggleGroups, 300);
	});

	// Для динамической загрузки ACF
	$(document).on('acf/setup_fields', function() {
		setTimeout(initToggleGroups, 100);
	});

})(jQuery);
