<?php
/**
 * Список вакансий с аккордеонами
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Собираем вакансии из фиксированных полей ACF (до 5 вакансий)
$vacancies = array();
for ( $i = 1; $i <= 5; $i++ ) {
	$title        = function_exists( 'get_field' ) ? get_field( 'gociss_vacancy_' . $i . '_title' ) : '';
	$requirements = function_exists( 'get_field' ) ? get_field( 'gociss_vacancy_' . $i . '_requirements' ) : '';
	$qualities    = function_exists( 'get_field' ) ? get_field( 'gociss_vacancy_' . $i . '_qualities' ) : '';
	$conditions   = function_exists( 'get_field' ) ? get_field( 'gociss_vacancy_' . $i . '_conditions' ) : '';
	$salary       = function_exists( 'get_field' ) ? get_field( 'gociss_vacancy_' . $i . '_salary' ) : '';

	if ( $title ) {
		$vacancies[] = array(
			'title'        => $title,
			'requirements' => $requirements,
			'qualities'    => $qualities,
			'conditions'   => $conditions,
			'salary'       => $salary,
		);
	}
}

// Кнопка CTA
$cta_text = function_exists( 'get_field' ) ? get_field( 'gociss_vacancies_cta_text' ) : '';
$cta_url  = function_exists( 'get_field' ) ? get_field( 'gociss_vacancies_cta_url' ) : '';

if ( empty( $cta_text ) ) {
	$cta_text = 'Оставить заявку';
}
if ( empty( $cta_url ) ) {
	$cta_url = '#contact-form';
}

// Демо-данные если нет вакансий в ACF
if ( empty( $vacancies ) ) {
	$vacancies = array(
		array(
			'title'        => 'Специалист по системе менеджмента безопасности пищевой продукции',
			'requirements' => "• Высшее образование (приоритетно пищевое или по специальности «управление качеством», «стандартизация и сертификация»);\n• Опыт работы на предприятиях пищевой индустрии в структуре отдела качества;\n• Практический опыт разработки и внедрения документации систем менеджмента безопасности пищевой промышленности (ХАССП, ИСО 22000, FSSC 22000);\n• Знание российского законодательства и нормативной документации в области качества и пищевой безопасности;\n• Знание стандартов по пищевой безопасности ISO 22000:2005 и стандартов по программам предварительных условий;\n• Опыт проведения внутренних/внешних аудитов и составления отчетов;\n• Опыт организации и прохождения аудитов 2-ой стороной и сертификационных аудитов;\n• Знание требований по разработке нормативной документации;\n• Уверенный пользователь ПК – хорошее знание программ Microsoft Office и умение работать с документами.\n• Расширение клиентской базы\n• Заключение договоров\n• Контроль исполнения договоров\n• Оказание консультаций предприятиям – заказчикам",
			'qualities'    => "• Коммуникабельность\n• Ответственность\n• Внимательность к деталям\n• Умение работать в команде\n• Стрессоустойчивость",
			'conditions'   => "• Официальное трудоустройство по ТК РФ\n• График работы: 5/2, с 9:00 до 18:00\n• Офис в центре Санкт-Петербурга\n• Корпоративное обучение\n• ДМС после испытательного срока",
			'salary'       => 'от 80 000 до 120 000 руб. (по результатам собеседования)',
		),
	);
}
?>

<section class="vacancies-list">
	<div class="container">
		<?php foreach ( $vacancies as $index => $vacancy ) : ?>
			<div class="vacancy-card">
				<h2 class="vacancy-card__title"><?php echo esc_html( $vacancy['title'] ); ?></h2>
				
				<div class="vacancy-card__accordions">
					<?php
					// Секции аккордеона
					$sections = array(
						array(
							'id'      => 'requirements',
							'title'   => 'Требования к кандидату',
							'content' => $vacancy['requirements'],
							'open'    => true, // Первая секция открыта по умолчанию
						),
						array(
							'id'      => 'qualities',
							'title'   => 'Личностные качества',
							'content' => $vacancy['qualities'],
							'open'    => false,
						),
						array(
							'id'      => 'conditions',
							'title'   => 'Условия',
							'content' => $vacancy['conditions'],
							'open'    => false,
						),
						array(
							'id'      => 'salary',
							'title'   => 'Заработная плата',
							'content' => $vacancy['salary'],
							'open'    => false,
						),
					);

					foreach ( $sections as $section ) :
						if ( empty( $section['content'] ) ) {
							continue;
						}
						$is_open_class = $section['open'] ? 'is-open' : '';
						$aria_expanded = $section['open'] ? 'true' : 'false';
						?>
						<div class="vacancy-accordion <?php echo esc_attr( $is_open_class ); ?>">
							<button class="vacancy-accordion__header" aria-expanded="<?php echo esc_attr( $aria_expanded ); ?>">
								<span class="vacancy-accordion__title"><?php echo esc_html( $section['title'] ); ?></span>
								<span class="vacancy-accordion__icon">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</span>
							</button>
							<div class="vacancy-accordion__content">
								<div class="vacancy-accordion__inner">
									<?php echo wp_kses_post( nl2br( $section['content'] ) ); ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>

		<!-- Кнопка CTA -->
		<div class="vacancies-list__cta">
			<a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn--secondary">
				<?php echo esc_html( $cta_text ); ?>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4.16667 10H15.8333M15.8333 10L10 4.16667M15.8333 10L10 15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</a>
		</div>
	</div>
</section>


