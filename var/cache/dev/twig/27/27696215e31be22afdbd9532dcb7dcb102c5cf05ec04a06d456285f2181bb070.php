<?php

/* @Demande/Default/demande.html.twig */
class __TwigTemplate_04083b851d93c014d4eeca3bd6f6bd70167e08a84c219ded4f9502f4d2043d5b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Demande/Default/demande.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Demande/Default/demande.html.twig"));

        // line 1
        echo "<head>
    <link href=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("template/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\"/>
    <link href=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("template/css/datepicker3.css"), "html", null, true);
        echo "\" rel=\"stylesheet\"/>
    <link href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("template/css/styles.css"), "html", null, true);
        echo "\" rel=\"stylesheet\"/>
</head>
<body>
";
        // line 7
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? $this->getContext($context, "form")), 'form_start');
        echo "

<div class=\"col-lg-12\">
    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">Ajouter votre demande</div>
        <div class=\"panel-body\">
            <div class=\"form-group\">

            <table border=\"0\">
                <tr>
                    <td height=\"30px\"><label>Categorie</label></td>
                    <td width=\"250px\"></td>
                    <td height=\"30px\"><label>Adresse</label></td>
                </tr>
                <tr>
                    <td height=\"50px\">";
        // line 22
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "cat", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "</td>
                    <td>";
        // line 23
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "cat", array()), 'errors');
        echo "</td>
                    <td height=\"50px\">";
        // line 24
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "address", array()), 'widget', array("attr" => array("class" => "form-control", "placeholder" => "Address")));
        echo "</td>

                </tr>
                <tr>
                    <td height=\"50px\"><label>Disctiption</label></td>
                    <td></td>
                    <td height=\"50px\"><label>Contact</label></td>
                </tr>
                <tr>
                    <td height=\"50px\">";
        // line 33
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "dis", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "</td>
                    <td>";
        // line 34
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "dis", array()), 'errors');
        echo "</td>
                    <td height=\"50px\">";
        // line 35
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "contact", array()), 'widget', array("attr" => array("class" => "form-control", "placeholder" => "Contact")));
        echo "</td>
                </tr>
                <tr>
                    <td height=\"50px\"><label>Photo</label></td>
                </tr>
                <tr>
                    <td height=\"30px\">";
        // line 41
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "photo", array()), 'widget', array("attr" => array("class" => "form-control", "placeholder" => "Photo")));
        echo "</td>
                    <td>";
        // line 42
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "photo", array()), 'errors');
        echo "</td>
                </tr>
                <tr>
                    <td height=\"50px\"><label>Prix</label></td>
                </tr>
                <tr>
                    <td height=\"30px\">";
        // line 48
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "prix", array()), 'widget', array("attr" => array("class" => "form-control", "placeholder" => "Prix")));
        echo "</td>
                    <td>";
        // line 49
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "prix", array()), 'errors');
        echo "</td>
                </tr>
                <tr>
                    <td height=\"50px\">";
        // line 52
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["form"] ?? $this->getContext($context, "form")), "Demander", array()), 'widget', array("attr" => array("class" => "btn btn-primary", "value" => "Valider")));
        echo "</td>
                </tr>
            </table>
        </div>
    </div>
    </div>
</div>
</body>

";
        // line 61
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["form"] ?? $this->getContext($context, "form")), 'form_end');
        echo "
</body>";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "@Demande/Default/demande.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 61,  120 => 52,  114 => 49,  110 => 48,  101 => 42,  97 => 41,  88 => 35,  84 => 34,  80 => 33,  68 => 24,  64 => 23,  60 => 22,  42 => 7,  36 => 4,  32 => 3,  28 => 2,  25 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<head>
    <link href=\"{{ asset('template/css/bootstrap.min.css') }}\" rel=\"stylesheet\"/>
    <link href=\"{{ asset('template/css/datepicker3.css') }}\" rel=\"stylesheet\"/>
    <link href=\"{{ asset('template/css/styles.css') }}\" rel=\"stylesheet\"/>
</head>
<body>
{{ form_start(form)}}

<div class=\"col-lg-12\">
    <div class=\"panel panel-default\">
        <div class=\"panel-heading\">Ajouter votre demande</div>
        <div class=\"panel-body\">
            <div class=\"form-group\">

            <table border=\"0\">
                <tr>
                    <td height=\"30px\"><label>Categorie</label></td>
                    <td width=\"250px\"></td>
                    <td height=\"30px\"><label>Adresse</label></td>
                </tr>
                <tr>
                    <td height=\"50px\">{{ form_widget(form.cat,{ 'attr': {'class': 'form-control'} } ) }}</td>
                    <td>{{ form_errors(form.cat) }}</td>
                    <td height=\"50px\">{{ form_widget(form.address,{ 'attr': {'class': 'form-control','placeholder':'Address'} } ) }}</td>

                </tr>
                <tr>
                    <td height=\"50px\"><label>Disctiption</label></td>
                    <td></td>
                    <td height=\"50px\"><label>Contact</label></td>
                </tr>
                <tr>
                    <td height=\"50px\">{{ form_widget(form.dis,{ 'attr': {'class': 'form-control'} })}}</td>
                    <td>{{ form_errors(form.dis) }}</td>
                    <td height=\"50px\">{{ form_widget(form.contact,{ 'attr': {'class': 'form-control','placeholder':'Contact'} })}}</td>
                </tr>
                <tr>
                    <td height=\"50px\"><label>Photo</label></td>
                </tr>
                <tr>
                    <td height=\"30px\">{{ form_widget(form.photo,{ 'attr': {'class': 'form-control','placeholder':'Photo'} })}}</td>
                    <td>{{ form_errors(form.photo) }}</td>
                </tr>
                <tr>
                    <td height=\"50px\"><label>Prix</label></td>
                </tr>
                <tr>
                    <td height=\"30px\">{{ form_widget(form.prix,{ 'attr': {'class': 'form-control','placeholder':'Prix'} })}}</td>
                    <td>{{ form_errors(form.prix) }}</td>
                </tr>
                <tr>
                    <td height=\"50px\">{{ form_widget(form.Demander,{ 'attr': {'class': 'btn btn-primary','value':'Valider'} })}}</td>
                </tr>
            </table>
        </div>
    </div>
    </div>
</div>
</body>

{{ form_end(form)}}
</body>", "@Demande/Default/demande.html.twig", "C:\\wamp64\\www\\FixIt\\src\\DemandeBundle\\Resources\\views\\Default\\demande.html.twig");
    }
}
