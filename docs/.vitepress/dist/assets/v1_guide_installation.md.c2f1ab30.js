import{_ as a,o as n,c as e,V as s}from"./chunks/framework.b92b8613.js";const _=JSON.parse('{"title":"Installation","description":"","frontmatter":{},"headers":[],"relativePath":"v1/guide/installation.md","filePath":"v1/guide/installation.md"}'),t={name:"v1/guide/installation.md"},o=s('<h1 id="installation" tabindex="-1">Installation <a class="header-anchor" href="#installation" aria-label="Permalink to &quot;Installation&quot;">​</a></h1><p>Anonymizer can be installed through composer</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki material-theme-palenight"><code><span class="line"><span style="color:#FFCB6B;">composer</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">require</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">yormy/anonymizer-laravel</span></span></code></pre></div><h1 id="dry-run" tabindex="-1">Dry run <a class="header-anchor" href="#dry-run" aria-label="Permalink to &quot;Dry run&quot;">​</a></h1><p>you can run the anonymizer without performing actions to give you a clue about what is going to happen.</p><div class="language-"><button title="Copy Code" class="copy"></button><span class="lang"></span><pre class="shiki material-theme-palenight"><code><span class="line"><span style="color:#A6ACCD;">php artisan db:anonymize --pretend</span></span></code></pre></div><h1 id="normal-run" tabindex="-1">Normal run <a class="header-anchor" href="#normal-run" aria-label="Permalink to &quot;Normal run&quot;">​</a></h1><div class="language-"><button title="Copy Code" class="copy"></button><span class="lang"></span><pre class="shiki material-theme-palenight"><code><span class="line"><span style="color:#A6ACCD;">php artisan db:anonymize</span></span></code></pre></div>',8),l=[o];function i(r,p,c,d,h,u){return n(),e("div",null,l)}const y=a(t,[["render",i]]);export{_ as __pageData,y as default};