import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Inicializar WebView
        WebView webView = findViewById(R.id.webView);

        // Configurar WebView para habilitar JavaScript
        WebSettings webSettings = webView.getSettings();
        webSettings.setJavaScriptEnabled(true);

        // Para asegurar que la navegación ocurra dentro de la app en lugar de abrirse en el navegador externo
        webView.setWebViewClient(new WebViewClient());

        // Cargar la página web desde tu servidor local
        webView.loadUrl("http://192.168.0.219/inviza/index.html");
    }
}
