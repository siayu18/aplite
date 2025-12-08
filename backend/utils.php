<!-- <?php
/**
 * Validate form fields
 * @param array $data - associative array of form data, e.g., $_POST
 * @param array $rules - array of rules, each rule: ['field'=>'name','type'=>'required|integer','label'=>'Label']
 * @return array - array of error messages
 */
function validateForm(array $data, array $rules): array {
    $errors = [];

    foreach ($rules as $rule) {
        $field = $rule['field'];
        $label = $rule['label'] ?? $field;

        $value = isset($data[$field]) ? trim($data[$field]) : '';

        switch ($rule['type']) {
            case 'required':
                if ($value === '') {
                    $errors[] = "$label cannot be empty.";
                }
                break;

            case 'integer':
                if ($value !== '' && !ctype_digit($value)) {
                    $errors[] = "$label must be an integer.";
                }
                break;

            // Add more validation types if needed
        }
    }

    return $errors;
}
?> -->
