<?php

declare(strict_types=1);

namespace ServicioLineaOnce\Prisma11\Tests\Feature;

use Illuminate\Support\Facades\Blade;
use ServicioLineaOnce\Prisma11\Tests\TestCase;

class FlowbiteComponentsTest extends TestCase
{
    public function test_button_group_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-button-group><x-p11-button>A</x-p11-button><x-p11-button>B</x-p11-button></x-p11-button-group>');

        $this->assertStringContainsString('role="group"', $rendered);
        $this->assertStringContainsString('inline-flex', $rendered);
    }

    public function test_kbd_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-kbd>Shift</x-p11-kbd>');

        $this->assertStringContainsString('<kbd', $rendered);
        $this->assertStringContainsString('Shift', $rendered);
        $this->assertStringContainsString('font-mono', $rendered);
    }

    public function test_indicator_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-indicator color="green" ping="true" />');

        $this->assertStringContainsString('animate-ping', $rendered);
        $this->assertStringContainsString('bg-green-500', $rendered);
    }

    public function test_qr_code_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-qr-code value="https://flowbite.com" title="Escanear" />');

        $this->assertStringContainsString('qrserver.com', $rendered);
        $this->assertStringContainsString('Escanear', $rendered);
    }

    public function test_file_input_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-file-input label="Subir CV" helper="PDF máx 5MB" />');

        $this->assertStringContainsString('type="file"', $rendered);
        $this->assertStringContainsString('Subir CV', $rendered);
        $this->assertStringContainsString('PDF máx 5MB', $rendered);
    }

    public function test_search_input_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-search-input placeholder="Buscar producto..." button="Ir" />');

        $this->assertStringContainsString('type="search"', $rendered);
        $this->assertStringContainsString('Buscar producto...', $rendered);
        $this->assertStringContainsString('Ir', $rendered);
    }

    public function test_number_input_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-number-input min="0" max="10" value="5" label="Cantidad" />');

        $this->assertStringContainsString('type="number"', $rendered);
        $this->assertStringContainsString('Cantidad', $rendered);
    }

    public function test_select_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-select label="País" :options="[\'mx\' => \'México\', \'co\' => \'Colombia\']" />');

        $this->assertStringContainsString('<select', $rendered);
        $this->assertStringContainsString('México', $rendered);
        $this->assertStringContainsString('Colombia', $rendered);
    }

    public function test_range_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-range min="10" max="100" label="Volumen" />');

        $this->assertStringContainsString('type="range"', $rendered);
        $this->assertStringContainsString('Volumen', $rendered);
    }

    public function test_floating_label_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-floating-label label="Correo electrónico" type="email" />');

        $this->assertStringContainsString('peer', $rendered);
        $this->assertStringContainsString('Correo electrónico', $rendered);
    }

    public function test_phone_input_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-phone-input label="Teléfono" />');

        $this->assertStringContainsString('type="tel"', $rendered);
        $this->assertStringContainsString('+57', $rendered);
    }

    public function test_timepicker_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-timepicker label="Hora de cita" />');

        $this->assertStringContainsString('type="time"', $rendered);
        $this->assertStringContainsString('Hora de cita', $rendered);
    }

    public function test_datepicker_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-datepicker label="Fecha de evento" />');

        $this->assertStringContainsString('type="date"', $rendered);
        $this->assertStringContainsString('Fecha de evento', $rendered);
    }

    public function test_banner_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-banner>Anuncio importante</x-p11-banner>');

        $this->assertStringContainsString('Anuncio importante', $rendered);
        $this->assertStringContainsString('fixed top-0', $rendered);
    }

    public function test_drawer_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-drawer title="Menú Drawer">Contenido drawer</x-p11-drawer>');

        $this->assertStringContainsString('Menú Drawer', $rendered);
        $this->assertStringContainsString('Contenido drawer', $rendered);
    }

    public function test_popover_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-popover title="Info popover" content="Detalle de ayuda"><button>Trigger</button></x-p11-popover>');

        $this->assertStringContainsString('Info popover', $rendered);
        $this->assertStringContainsString('Detalle de ayuda', $rendered);
    }

    public function test_navbar_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-navbar brand="Mi App"><li><a href="/">Inicio</a></li></x-p11-navbar>');

        $this->assertStringContainsString('<nav', $rendered);
        $this->assertStringContainsString('Mi App', $rendered);
        $this->assertStringContainsString('Inicio', $rendered);
    }

    public function test_sidebar_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-sidebar><li>Dashboard</li></x-p11-sidebar>');

        $this->assertStringContainsString('<aside', $rendered);
        $this->assertStringContainsString('Dashboard', $rendered);
    }

    public function test_footer_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-footer brand="Mi Empresa"><li>Contacto</li></x-p11-footer>');

        $this->assertStringContainsString('<footer', $rendered);
        $this->assertStringContainsString('Mi Empresa', $rendered);
        $this->assertStringContainsString('Contacto', $rendered);
    }

    public function test_stepper_renders_correctly(): void
    {
        $steps = [
            ['title' => 'Paso 1', 'completed' => true],
            ['title' => 'Paso 2', 'active' => true],
            ['title' => 'Paso 3', 'completed' => false],
        ];
        $rendered = Blade::render('<x-p11-stepper :steps="$steps" />', ['steps' => $steps]);

        $this->assertStringContainsString('Paso 1', $rendered);
        $this->assertStringContainsString('Paso 2', $rendered);
        $this->assertStringContainsString('Paso 3', $rendered);
    }

    public function test_carousel_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-carousel :slides="3"><div>Slide 1</div></x-p11-carousel>');

        $this->assertStringContainsString('Slide 1', $rendered);
        $this->assertStringContainsString('Anterior', $rendered);
        $this->assertStringContainsString('Siguiente', $rendered);
    }

    public function test_chat_bubble_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-chat-bubble sender="Carlos" time="10:30">Hola amigo</x-p11-chat-bubble>');

        $this->assertStringContainsString('Carlos', $rendered);
        $this->assertStringContainsString('10:30', $rendered);
        $this->assertStringContainsString('Hola amigo', $rendered);
    }

    public function test_clipboard_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-clipboard value="npm i flowbite" />');

        $this->assertStringContainsString('npm i flowbite', $rendered);
        $this->assertStringContainsString('navigator.clipboard.writeText', $rendered);
    }

    public function test_device_mockup_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-device-mockup device="iphone"><div>App Screen</div></x-p11-device-mockup>');

        $this->assertStringContainsString('App Screen', $rendered);
        $this->assertStringContainsString('rounded-[2.5rem]', $rendered);
    }

    public function test_gallery_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-gallery cols="3"><div>Foto 1</div></x-p11-gallery>');

        $this->assertStringContainsString('grid-cols-2 md:grid-cols-3', $rendered);
        $this->assertStringContainsString('Foto 1', $rendered);
    }

    public function test_jumbotron_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-jumbotron title="Bienvenido" description="Subtítulo">Boton</x-p11-jumbotron>');

        $this->assertStringContainsString('Bienvenido', $rendered);
        $this->assertStringContainsString('Subtítulo', $rendered);
    }

    public function test_list_group_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-list-group><li>Item 1</li><li>Item 2</li></x-p11-list-group>');

        $this->assertStringContainsString('Item 1', $rendered);
        $this->assertStringContainsString('divide-y', $rendered);
    }

    public function test_progress_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-progress value="75" color="green" label="Progreso" showPercent="true" />');

        $this->assertStringContainsString('75%', $rendered);
        $this->assertStringContainsString('bg-green-600', $rendered);
    }

    public function test_rating_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-rating rating="4" max="5" count="120" score="4.8" />');

        $this->assertStringContainsString('(120)', $rendered);
        $this->assertStringContainsString('4.8', $rendered);
    }

    public function test_speed_dial_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-speed-dial><button>Acción</button></x-p11-speed-dial>');

        $this->assertStringContainsString('Acción', $rendered);
        $this->assertStringContainsString('Menú rápido', $rendered);
    }

    public function test_timeline_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-timeline><x-p11-timeline-item date="Enero 2026" title="Hito 1">Detalles</x-p11-timeline-item></x-p11-timeline>');

        $this->assertStringContainsString('Enero 2026', $rendered);
        $this->assertStringContainsString('Hito 1', $rendered);
        $this->assertStringContainsString('Detalles', $rendered);
    }

    public function test_video_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-video src="/video.mp4" />');

        $this->assertStringContainsString('<video', $rendered);
        $this->assertStringContainsString('/video.mp4', $rendered);
    }

    public function test_datatable_renders_correctly(): void
    {
        $headers = ['id' => 'ID', 'name' => 'Nombre'];
        $rows = [['id' => 1, 'name' => 'Alice'], ['id' => 2, 'name' => 'Bob']];
        $rendered = Blade::render('<x-p11-datatable :headers="$headers" :rows="$rows" />', [
            'headers' => $headers,
            'rows' => $rows,
        ]);

        $this->assertStringContainsString('Alice', $rendered);
        $this->assertStringContainsString('Filtrar registros...', $rendered);
    }

    public function test_chart_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-chart title="Ventas" subtitle="Mensual"><div>Canvas</div></x-p11-chart>');

        $this->assertStringContainsString('Ventas', $rendered);
        $this->assertStringContainsString('Mensual', $rendered);
    }

    public function test_wysiwyg_renders_correctly(): void
    {
        $rendered = Blade::render('<x-p11-wysiwyg placeholder="Escribe tu post...">Contenido inicial</x-p11-wysiwyg>');

        $this->assertStringContainsString('Contenido inicial', $rendered);
        $this->assertStringContainsString('Escribe tu post...', $rendered);
    }

    public function test_typography_components_render_correctly(): void
    {
        $h = Blade::render('<x-p11-heading level="1">Título Principal</x-p11-heading>');
        $p = Blade::render('<x-p11-paragraph variant="lead">Párrafo destacado</x-p11-paragraph>');
        $quote = Blade::render('<x-p11-blockquote author="Steve Jobs">Innovación</x-p11-blockquote>');
        $hr = Blade::render('<x-p11-hr text="O continuar con" />');
        $link = Blade::render('<x-p11-link href="https://flowbite.com">Flowbite</x-p11-link>');
        $text = Blade::render('<x-p11-text variant="highlight">Importante</x-p11-text>');

        $this->assertStringContainsString('<h1', $h);
        $this->assertStringContainsString('Título Principal', $h);
        $this->assertStringContainsString('text-xl font-normal', $p);
        $this->assertStringContainsString('Steve Jobs', $quote);
        $this->assertStringContainsString('O continuar con', $hr);
        $this->assertStringContainsString('href="https://flowbite.com"', $link);
        $this->assertStringContainsString('bg-blue-600', $text);
    }
}
