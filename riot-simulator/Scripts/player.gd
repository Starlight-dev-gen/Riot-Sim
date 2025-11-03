extends Area2D
@export var speed = 400 # Player speed (pixels/sec).
var screen_size # Window size.
signal hit


# Called when the node enters the scene tree for the first time.
func _ready() -> void:
	# screen_size = get_viewport_rect().size
	get_node("AnimatedSprite2D").play()
	# hide()


# Called every frame. 'delta' is the elapsed time since the previous frame.
func _process(delta: float) -> void:
	screen_size = get_viewport_rect().size # GOOD CHANGE. KEEP. FIND A WAY TO FIX ENEMY SPAWN.
	var velocity = Vector2.ZERO
	
	if Input.is_action_pressed("Move_right"):
		velocity.x += 1
	if Input.is_action_pressed("Move_left"):
		velocity.x -= 1
	if Input.is_action_pressed("Move_up"):
		velocity.y -= 1
	if Input.is_action_pressed("Move_down"):
		velocity.y += 1
	
	if velocity.length() > 0:
		velocity = velocity.normalized() * speed
	# else:
	# 	get_node("AnimatedSprite2D").stop()
	
	position += velocity * delta
	position = position.clamp(Vector2.ZERO, screen_size)
	
	if velocity.x != 0 or velocity.y != 0:
		get_node("AnimatedSprite2D").animation = "walk"
		get_node("AnimatedSprite2D").flip_h = velocity.x > 0
	elif velocity.x == 0 and velocity.y == 0:
		get_node("AnimatedSprite2D").animation = "default"


func _on_body_entered(body: Node2D) -> void:
	hit.emit()
	get_node("CollisionShape2D").set_deferred("disabled", false)
	# Don't disable collision shape while collision is being calculated
	
