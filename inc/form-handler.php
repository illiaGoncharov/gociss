<?php
/**
 * Обработчик формы обратной связи
 *
 * @package Gociss
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Обработка AJAX запроса формы
 */
function gociss_handle_contact_form() {
	// Проверка nonce
	if ( ! isset( $_POST['gociss_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['gociss_contact_nonce'] ) ), 'gociss_contact_form' ) ) {
		wp_send_json_error( array( 'message' => 'Ошибка безопасности. Обновите страницу и попробуйте снова.' ) );
	}

	// Получение и санитизация данных
	$name    = isset( $_POST['gociss_name'] ) ? sanitize_text_field( wp_unslash( $_POST['gociss_name'] ) ) : '';
	$company = isset( $_POST['gociss_company'] ) ? sanitize_text_field( wp_unslash( $_POST['gociss_company'] ) ) : '';
	$phone   = isset( $_POST['gociss_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['gociss_phone'] ) ) : '';
	$email   = isset( $_POST['gociss_email'] ) ? sanitize_email( wp_unslash( $_POST['gociss_email'] ) ) : '';
	$service = isset( $_POST['gociss_service'] ) ? sanitize_text_field( wp_unslash( $_POST['gociss_service'] ) ) : '';
	$consent = isset( $_POST['gociss_consent'] ) ? true : false;

	// Валидация обязательных полей
	if ( empty( $name ) || empty( $phone ) || empty( $email ) ) {
		wp_send_json_error( array( 'message' => 'Пожалуйста, заполните все обязательные поля.' ) );
	}

	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Пожалуйста, введите корректный email адрес.' ) );
	}

	if ( ! $consent ) {
		wp_send_json_error( array( 'message' => 'Необходимо согласие на обработку персональных данных.' ) );
	}

	// Подготовка данных для email
	$subject = 'Новая заявка с сайта ' . get_bloginfo( 'name' );
	$message = "Новая заявка с сайта:\n\n";
	$message .= "Имя: {$name}\n";
	$message .= "Компания: {$company}\n";
	$message .= "Телефон: {$phone}\n";
	$message .= "Email: {$email}\n";
	$message .= "Тип услуги: {$service}\n";

	// Отправка email
	$to      = get_option( 'admin_email' );
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

	$sent = wp_mail( $to, $subject, $message, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => 'Спасибо! Ваша заявка успешно отправлена. Мы свяжемся с вами в ближайшее время.' ) );
	} else {
		wp_send_json_error( array( 'message' => 'Произошла ошибка при отправке заявки. Попробуйте позже или свяжитесь с нами по телефону.' ) );
	}
}
add_action( 'wp_ajax_gociss_contact_form', 'gociss_handle_contact_form' );
add_action( 'wp_ajax_nopriv_gociss_contact_form', 'gociss_handle_contact_form' );

