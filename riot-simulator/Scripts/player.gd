extends Area2D
@export var speed = 400 # Player speed (pixels/sec).
var screen_size # Window size.
signal hit
var got_hit = false
var mouse_pos
var is_attacking = false
@export var melee_range = 80

# Called when the node enters the scene tree for the first time.
func _ready() -> void:
	# screen_size = get_viewport_rect().size
	get_node("AnimatedSprite2D").play()
	_on_attack_animation_finished()
	# hide()


# Called every frame. 'delta' is the elapsed time since the previous frame.
func _process(delta: float) -> void:
	screen_size = get_viewport_rect().size # GOOD CHANGE. KEEP. FIND A WAY TO FIX ENEMY SPAWN.
	mouse_pos = get_global_mouse_position()
	var velocity = Vector2.ZERO
	if not got_hit:
		if Input.is_action_pressed("Move_right"):
			velocity.x += 1
		if Input.is_action_pressed("Move_left"):
			velocity.x -= 1
		if Input.is_action_pressed("Move_up"):
			velocity.y -= 1
		if Input.is_action_pressed("Move_down"):
			velocity.y += 1
		#if Input.is_action_pressed("Attack"):
		#	var atk_vector = (mouse_pos - position).clamp(
		#		Vector2(-melee_range, -melee_range - 20), Vector2(melee_range, melee_range + 20))
		#	get_node("Attack").position = atk_vector
		#	get_node("Attack").rotation = PI + get_angle_to(get_global_mouse_position())
		#	get_node("Attack/AttackSprite").play()
	
	if velocity.length() > 0:
		velocity = velocity.normalized() * speed
	# else:
	# 	get_node("AnimatedSprite2D").stop()
	
	position += velocity * delta
	position = position.clamp(Vector2.ZERO, screen_size)
	
	if velocity.x != 0 or velocity.y != 0:
		get_node("AnimatedSprite2D").animation = "walk"
		get_node("AnimatedSprite2D").flip_h = velocity.x > 0
	elif velocity.x == 0 and velocity.y == 0 and not got_hit:
		get_node("AnimatedSprite2D").animation = "default"
	elif got_hit:
		get_node("AnimatedSprite2D").animation = "get_hit"


func _on_body_entered(body: Node2D) -> void:
	hit.emit()
	got_hit = true
	if get_tree() != null:
		await get_tree().create_timer(0.25).timeout
	got_hit = false
	get_node("CollisionShape2D").set_deferred("disabled", false)
	# Don't disable collision shape while collision is being calculated


func _on_attack_animation_finished() -> void:
	get_node("Attack/AttackSprite").stop()
