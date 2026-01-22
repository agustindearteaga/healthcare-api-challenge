# Comandos para probar endpoints en Tinker

Ejecuta `php artisan tinker` y luego copia y pega estos comandos:

## 1. Crear datos de prueba

```php
use Lightit\Clinics\Domain\Models\Clinic;
use Lightit\Doctors\Domain\Models\Doctor;

// Crear clinics
$clinic1 = Clinic::create(['name' => 'Clínica Central', 'address' => 'Av. Principal 123']);
$clinic2 = Clinic::create(['name' => 'Clínica Norte', 'address' => 'Calle Norte 456']);
$clinic3 = Clinic::create(['name' => 'Clínica Sur', 'address' => 'Boulevard Sur 789']);

// Crear doctors
$doctor1 = Doctor::create(['name' => 'Dr. Juan Pérez']);
$doctor2 = Doctor::create(['name' => 'Dra. María García']);

echo "✓ Datos creados\n";
echo "Clinics: {$clinic1->id}, {$clinic2->id}, {$clinic3->id}\n";
echo "Doctors: {$doctor1->id}, {$doctor2->id}\n";
```

## 2. Probar endpoints de Clinics

### Listar clinics
```php
$response = app()->handle(\Illuminate\Http\Request::create('/api/clinics', 'GET'));
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

### Obtener una clinic
```php
$response = app()->handle(\Illuminate\Http\Request::create("/api/clinics/{$clinic1->id}", 'GET'));
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

### Crear clinic
```php
$response = app()->handle(
    \Illuminate\Http\Request::create('/api/clinics', 'POST', [
        'name' => 'Clínica Nueva',
        'address' => 'Calle Nueva 999',
    ])
);
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
$newClinic = json_decode($response->getContent(), true);
$newClinicId = $newClinic['data']['id'] ?? null;
```

### Actualizar clinic
```php
$response = app()->handle(
    \Illuminate\Http\Request::create("/api/clinics/{$clinic1->id}", 'PUT', [
        'name' => 'Clínica Actualizada',
        'address' => 'Dirección Actualizada 111',
    ])
);
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

### Listar con filtros
```php
$response = app()->handle(\Illuminate\Http\Request::create('/api/clinics?filter[name]=Norte', 'GET'));
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

### Listar con ordenamiento
```php
$response = app()->handle(\Illuminate\Http\Request::create('/api/clinics?sort=name', 'GET'));
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

### Eliminar clinic
```php
$response = app()->handle(\Illuminate\Http\Request::create("/api/clinics/{$clinic3->id}", 'DELETE'));
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

## 3. Probar endpoint de Assignment

### Asignar doctor a clinics
```php
$response = app()->handle(
    \Illuminate\Http\Request::create("/api/doctors/{$doctor1->id}/clinics", 'PUT', [
        'clinic_ids' => [$clinic1->id, $clinic2->id],
    ])
);
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

### Verificar asignación (ver doctor con sus clinics)
```php
$response = app()->handle(\Illuminate\Http\Request::create("/api/doctors/{$doctor1->id}", 'GET'));
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

### Actualizar asignación (cambiar clinics del doctor)
```php
$response = app()->handle(
    \Illuminate\Http\Request::create("/api/doctors/{$doctor1->id}/clinics", 'PUT', [
        'clinic_ids' => [$clinic2->id, $clinic3->id],
    ])
);
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

### Asignar otro doctor a diferentes clinics
```php
$response = app()->handle(
    \Illuminate\Http\Request::create("/api/doctors/{$doctor2->id}/clinics", 'PUT', [
        'clinic_ids' => [$clinic1->id],
    ])
);
echo "Status: {$response->getStatusCode()}\n";
echo $response->getContent() . "\n";
```

## 4. Verificar relaciones

```php
// Ver clinics de un doctor
$doctor1->load('clinics');
$doctor1->clinics;

// Ver doctors de una clinic
$clinic1->load('doctors');
$clinic1->doctors;
```

