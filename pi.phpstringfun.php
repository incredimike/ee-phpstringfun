<?php
  
$plugin_info = array(
  'pi_name' => 'PHPStringFun',
  'pi_version' => '1.2.1',
  'pi_author' => 'Engaging.net',
  'pi_author_url' => 'http://www.engaging.net/products/phpstringfun',
  'pi_description' => 'Fun with strings! A gateway to the PHP string functions without using PHP in a template',
  'pi_usage' => Phpstringfun::usage()
);

class Phpstringfun
{
	var $return_data = "";

	function Phpstringfun()
	{
		global $TMPL;
		$version = "";
		if ( $TMPL )
		{
			$version = "1";
		}
		else
		{
			$version = "2";
		}
		if ($version == "2")
		{
			$this->EE =& get_instance();
			$TMPL = $this->EE->TMPL;
		}
		
		$result="";
		$final_result="";
		
		$fun = $TMPL->fetch_param('function');
		$par1 = $TMPL->fetch_param('par1');
		$par2 = $TMPL->fetch_param('par2');
		$par3 = $TMPL->fetch_param('par3');
		$par4 = $TMPL->fetch_param('par4');
		$par5 = $TMPL->fetch_param('par5');
		$array_index = $TMPL->fetch_param('array_index');
		$reverse = $TMPL->fetch_param('reverse');
		$separator = $TMPL->fetch_param('separator');
		if ($array_index < 1)
		{
			$array_index == "0";
		}
		$fun_choices = array('addcslashes', 'bin2hex', 'chop', 'chr', 'chunk_split', 'convert_cyr_string', 'convert_uudecode', 'convert_uuencode', 'count_chars', 'crc32', 'crypt', 'echo', 'explode', 'get_html_translation_table', 'hebrev', 'hebrevc', 'html_entity_decode', 'htmlentities', 'htmlspecialchars_decode', 'htmlspecialchars', 'join', 'levenshtein', 'localeconv', 'ltrim', 'md5_file', 'md5', 'metaphone', 'money_format', 'nl_langinfo', 'nl2br', 'number_format', 'ord', 'parse_str', 'print', 'printf', 'quoted_printable_decode', 'quotemeta', 'rtrim', 'setlocale', 'sha1_file', 'sha1', 'similar_text', 'soundex', 'sprintf', 'sscanf', 'str_ireplace', 'str_pad', 'str_repeat', 'str_replace', 'str_rot13', 'str_shuffle', 'str_split', 'str_word_count', 'strcasecmp', 'strchr', 'strcmp', 'strcoll', 'strcspn', 'strip_tags', 'stripcslashes', 'stripos', 'stripslashes', 'stristr', 'strlen', 'strnatcasecmp', 'strnatcmp', 'strncasecmp', 'strncmp', 'strpbrk', 'strpos', 'strrchr', 'strrev', 'strripos', 'strrpos', 'strspn', 'strstr', 'strtok', 'strtolower', 'strtoupper', 'strtr', 'substr_compare', 'substr_count', 'substr_replace', 'substr', 'trim', 'ucfirst', 'ucwords', 'urlencode', 'vfprintf', 'vprintf', 'vsprintf', 'wordwrap');

		if ($reverse=="Yes" || $reverse == "Y" || $reverse=="yes")
		{
			$reverse="y";
		}
		if (in_array($fun, $fun_choices))
		{
			if ($par5)
			{
				if ($reverse=="y")
				{
					$result = $fun($par5, $par4, $par3, $par2, $par1, $TMPL->tagdata); 
				}
				else
				{
					$result = $fun($TMPL->tagdata, $par1, $par2, $par3, $par4, $par5 ); 
				}
			}
			elseif ($par4) 
			{ 
				if ($reverse=="y")
				{
					$result = $fun($par4, $par3, $par2, $par1, $TMPL->tagdata); 
				}
				else
				{
					$result = $fun($TMPL->tagdata, $par1, $par2, $par3, $par4); 
				}
			}
			elseif ($par3) 
			{
				if ($reverse=="y")
				{
					$result = $fun($par3, $par2, $par1, $TMPL->tagdata); 
				}
				else
				{
					$result = $fun($TMPL->tagdata, $par1, $par2, $par3); 
				}
			}
			elseif ($par2) 
			{
				if ($reverse=="y")
				{
					$result = $fun($par2, $par1, $TMPL->tagdata); 
				}
				else
				{
					$result = $fun($TMPL->tagdata, $par1, $par2); 
				}
			}
			elseif ($par1) 
			{
				if ($reverse=="y")
				{
					$result = $fun($par1, $TMPL->tagdata); 
				}
				else
				{
					$result = $fun($TMPL->tagdata, $par1); 
				}
			}
			else 
			{
				$result = $fun($TMPL->tagdata);
			}
			if ( is_array($result) )
			{
				if ($array_index)
				{
					$final_result = $result[$array_index];
				}
				else
				{
					foreach($result AS $result_instance)
					{
						$final_result .= $result_instance . $separator;
					}
				}
			}
			else
			{
				$final_result = $result;
			}
			$this->return_data = $final_result;
		}
		else 
		{
			$this->return_data = "ERROR: PHPStringFun can't have fun with the '$fun' function.";
		}
	}

	//  Plugin Usage
	// ----------------------------------------

	// This function describes how the plugin is used.
	//  Make sure and use output buffering

	function usage()
	{
		ob_start();
		?>See the documentation at http://www.engaging.net/docs/phpstringfun
		<?php
		$buffer = ob_get_contents();

		ob_end_clean();

		return $buffer;
	}
	// END
}