[README_BragolaFIT.md](https://github.com/user-attachments/files/22533908/README_BragolaFIT.md)
# Bragola FIT

Loja online de suplementos desportivos com **front‑office** (catálogo, carrinho, checkout) e **back‑office** (dashboard e gestão de catálogo, utilizadores e encomendas). Projeto desenvolvido como Prova de Aptidão Profissional (PAP).

> 🇧🇷🇦🇴 O nome **Bragola FIT** nasce da fusão das origens da equipa: **Bra** (Brasil) + **gola** (Angola) + **FIT** (Fitness).

## ✨ Funcionalidades

### Área de Compras (Front‑office)
- Listagem de produtos na página inicial (novidades e mais vendidos).
- Filtros por **categoria** e **subcategoria**; pesquisa por nome.
- Página de categoria e página de subcategoria com grelha de produtos.
- **Carrinho de compras** persistente por utilizador (adicionar, remover, atualizar quantidades).
- **Checkout** com geração de encomenda e envio de **email** de confirmação ao cliente.
- **Lista de desejos** (favoritos) por utilizador autenticado.
- Autenticação: **registo, login e logout**.

### Back‑office (Dashboard)
- Cards com totais (utilizadores, produtos, encomendas, etc.).
- Gráficos (barras e donut) com **Chart.js**.
- Gestão de **Produtos** (CRUD com upload de imagem, stock e preço) usando **DataTables**.
- Gestão de **Categorias** (mãe) e **Subcategorias** (filhas).
- Gestão de **Utilizadores** (atribuição de perfil **Admin**/**User**).
- Gestão de **Encomendas** (consulta, alteração de estado: Em processamento → Enviado → Entregue).

### Modelo de Dados
- **Categorias** (1‑N) **Subcategorias**.
- **Produtos** (N‑N) **Subcategorias** via tabela *pivot*.
- **Carrinho** e **Products_Carts** (itens do carrinho por utilizador).
- **Encomendas** e **Order_Products** (histórico dos itens e preços no momento da compra).

## 🧰 Stack & Principais Bibliotecas
- **Laravel** (PHP) • ORM Eloquent • Migrations
- **Blade** (views), **Bootstrap** + CSS custom
- **jQuery** para interações e **AJAX**
- **DataTables**, **SweetAlert2**, **Chart.js**
- Base de dados **MySQL**/**MariaDB** (desenvolvido com Laragon localmente)
- **Vite** para *assets* (JS/CSS)

> O repositório segue a estrutura padrão de um projeto Laravel (`app/`, `routes/`, `resources/`, `database/`, etc.).

## 🚀 Como correr o projeto localmente

> Pré‑requisitos: PHP (>= 8.x), Composer, Node.js (>= 18), MySQL/MariaDB. Em Windows pode usar **Laragon** ou WAMP/XAMPP.

```bash
# 1) Clonar
git clone https://github.com/GabrielStangarlin/PAP_BragolaFIT.git
cd PAP_BragolaFIT

# 2) Dependências PHP e JS
composer install
npm install

# 3) Copiar e configurar variáveis de ambiente
cp .env.example .env

# 4) Gerar chave da aplicação
php artisan key:generate

# 5) Configurar base de dados (ver secção seguinte) e migrar
php artisan migrate

# (Opcional) Popular dados iniciais se existirem seeders
# php artisan db:seed

# 6) Link de storage (para imagens)
php artisan storage:link

# 7) Build/Dev dos assets
npm run dev     # durante o desenvolvimento
# npm run build # para produção

# 8) Servir a app
php artisan serve
# http://127.0.0.1:8000
```

## ⚙️ Configuração (.env)

No ficheiro `.env` ajuste pelo menos:

```dotenv
APP_NAME="Bragola FIT"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Base de dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bragolafit
DB_USERNAME=root
DB_PASSWORD=

# Email (para envio de confirmação de encomendas)
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@bragolafit.test"
MAIL_FROM_NAME="${APP_NAME}"
```

## 👤 Perfis e Acesso ao Back‑office

- Utilizadores com `isAdmin = 1` têm acesso ao **dashboard**.
- Utilizadores com `isAdmin = 0` são clientes (acesso à loja).
- Se não existir *seeder* de admin, pode promover um utilizador direto na BD:
  ```sql
  UPDATE users SET isAdmin = 1 WHERE email = 'o.teu@email';
  ```

## 🛒 Fluxos Principais

- **Adicionar ao carrinho** (requer sessão iniciada): cria/atualiza carrinho do utilizador e itens.
- **Checkout**: cria `orders` e registos em `order_products` com quantidades e preço aplicado; envia email ao cliente.
- **Lista de desejos**: *toggle* de favoritos por produto (ícone coração).
- **Gestão de encomendas**: alteração do estado (processamento → enviado → entregue).

## 🗂️ Estrutura de Tabelas (resumo)

- `categories` (categoria mãe)
- `subcategories` (FK `category_id`)
- `products`
- `product_subcategory` (tabela *pivot* N‑N)
- `carts` e `products_carts`
- `orders` e `order_products`
- `users` (campo `isAdmin`)

## 🧪 Rotas & Código

As rotas principais encontram‑se em `routes/` e a lógica nas *Controllers* dentro de `app/Http/Controllers/`. As *views* estão em `resources/views/` (Blade) e os ficheiros front‑end em `resources/` (JS/CSS).

## 📸 Screenshots (opcional)
Coloque aqui imagens do front‑office (home, categoria, carrinho, checkout) e do back‑office (dashboard, gestão de produtos, encomendas).

## 📚 Créditos
Projeto desenvolvido por **Gabriel Stangarlin** e **Mário Edson Fernandes Figueiredo** no âmbito da PAP (Escola Secundária D. Pedro V).

## 📝 Licença
Este repositório herda a licença definida no ficheiro `LICENSE` (ou, se ausente, considere adicionar uma licença — por exemplo **MIT**).

---

> Repositório: https://github.com/GabrielStangarlin/PAP_BragolaFIT
